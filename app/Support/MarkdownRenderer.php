<?php

declare(strict_types=1);

namespace LimaSite\Support;

final class MarkdownRenderer
{
    public function render(string $markdown): string
    {
        $lines = preg_split("/\r\n|\n|\r/", trim($markdown));

        if ($lines === false) {
            return '';
        }

        $html = [];
        $paragraph = [];
        $listItems = [];
        $tableLines = [];
        $inCodeBlock = false;
        $codeLanguage = '';
        $codeLines = [];

        $flushParagraph = function () use (&$html, &$paragraph): void {
            if ($paragraph === []) {
                return;
            }

            $text = trim(implode(' ', $paragraph));
            if ($text !== '') {
                $html[] = '<p>' . $this->parseInline($text) . '</p>';
            }

            $paragraph = [];
        };

        $flushList = function () use (&$html, &$listItems): void {
            if ($listItems === []) {
                return;
            }

            $items = array_map(
                fn (string $item): string => '<li>' . $this->parseInline(trim($item)) . '</li>',
                $listItems
            );

            $html[] = '<ul>' . implode('', $items) . '</ul>';
            $listItems = [];
        };

        $flushTable = function () use (&$html, &$tableLines): void {
            if (count($tableLines) < 2) {
                $tableLines = [];
                return;
            }

            $header = $this->parseTableRow($tableLines[0]);
            $separator = $this->parseTableRow($tableLines[1]);

            if ($header === [] || $separator === [] || count($header) !== count($separator)) {
                $tableLines = [];
                return;
            }

            $bodyRows = [];
            for ($i = 2; $i < count($tableLines); $i++) {
                $row = $this->parseTableRow($tableLines[$i]);
                if ($row !== []) {
                    $bodyRows[] = $row;
                }
            }

            $thead = '<thead><tr>' . implode('', array_map(
                fn (string $cell): string => '<th>' . $this->parseInline(trim($cell)) . '</th>',
                $header
            )) . '</tr></thead>';

            $tbody = '<tbody>';
            foreach ($bodyRows as $row) {
                $cells = array_map(
                    fn (string $cell): string => '<td>' . $this->parseInline(trim($cell)) . '</td>',
                    $row
                );
                $tbody .= '<tr>' . implode('', $cells) . '</tr>';
            }
            $tbody .= '</tbody>';

            $html[] = '<div class="docs-table-wrap"><table>' . $thead . $tbody . '</table></div>';
            $tableLines = [];
        };

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if (preg_match('/^```([\w-]+)?$/', $trimmed, $matches) === 1) {
                $flushParagraph();
                $flushList();
                $flushTable();

                if ($inCodeBlock) {
                    $languageClass = $codeLanguage !== '' ? ' class="language-' . $this->escape($codeLanguage) . '"' : '';
                    $html[] = '<pre><code' . $languageClass . '>' . $this->escape(implode("\n", $codeLines)) . '</code></pre>';
                    $codeLines = [];
                    $codeLanguage = '';
                    $inCodeBlock = false;
                } else {
                    $inCodeBlock = true;
                    $codeLanguage = $matches[1] ?? '';
                }

                continue;
            }

            if ($inCodeBlock) {
                $codeLines[] = rtrim($line, "\r");
                continue;
            }

            if ($trimmed === '') {
                $flushParagraph();
                $flushList();
                $flushTable();
                continue;
            }

            if ($this->isTableLine($trimmed)) {
                $flushParagraph();
                $flushList();
                $tableLines[] = $trimmed;
                continue;
            }

            if ($tableLines !== []) {
                $flushTable();
            }

            if (preg_match('/^(#{1,6})\s+(.+)$/', $trimmed, $matches) === 1) {
                $flushParagraph();
                $flushList();

                $level = strlen($matches[1]);
                $text = trim($matches[2]);
                $id = $this->slugify($text);
                $html[] = sprintf('<h%d id="%s">%s</h%d>', $level, $this->escape($id), $this->parseInline($text), $level);
                continue;
            }

            if (preg_match('/^- (.+)$/', $trimmed, $matches) === 1) {
                $flushParagraph();
                $listItems[] = $matches[1];
                continue;
            }

            $paragraph[] = $trimmed;
        }

        if ($inCodeBlock) {
            $languageClass = $codeLanguage !== '' ? ' class="language-' . $this->escape($codeLanguage) . '"' : '';
            $html[] = '<pre><code' . $languageClass . '>' . $this->escape(implode("\n", $codeLines)) . '</code></pre>';
        }

        $flushParagraph();
        $flushList();
        $flushTable();

        return implode("\n", $html);
    }

    private function parseInline(string $text): string
    {
        $escaped = $this->escape($text);

        $escaped = preg_replace_callback(
            '/`([^`]+)`/',
            fn (array $matches): string => '<code>' . $this->escape($matches[1]) . '</code>',
            $escaped
        ) ?? $escaped;

        $escaped = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $escaped) ?? $escaped;
        $escaped = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $escaped) ?? $escaped;
        $escaped = preg_replace('/_(.+?)_/s', '<em>$1</em>', $escaped) ?? $escaped;

        $escaped = preg_replace_callback(
            '/\[(.*?)\]\((.*?)\)/',
            function (array $matches): string {
                $label = $matches[1];
                $href = $this->transformLinkTarget($matches[2]);
                $attrs = str_starts_with($href, 'http') ? ' target="_blank" rel="noopener noreferrer"' : '';
                return '<a href="' . $this->escape($href) . '"' . $attrs . '>' . $label . '</a>';
            },
            $escaped
        ) ?? $escaped;

        return $escaped;
    }

    private function transformLinkTarget(string $href): string
    {
        if (preg_match('/^([A-Za-z0-9_-]+)\.md(?:\?id=([A-Za-z0-9_-]+))?$/', $href, $matches) === 1) {
            $url = '/docs?page=' . rawurlencode($matches[1]);
            if (!empty($matches[2])) {
                $url .= '#' . rawurlencode($matches[2]);
            }
            return $url;
        }

        return $href;
    }

    private function isTableLine(string $line): bool
    {
        return str_contains($line, '|');
    }

    /**
     * @return string[]
     */
    private function parseTableRow(string $line): array
    {
        $trimmed = trim($line);
        $trimmed = trim($trimmed, '|');

        if ($trimmed === '') {
            return [];
        }

        return array_map('trim', explode('|', $trimmed));
    }

    private function slugify(string $text): string
    {
        $slug = strtolower($text);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? $slug;
        return trim($slug, '-') ?: 'section';
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}
