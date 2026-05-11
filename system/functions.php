<?php

if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('lucide_icon')) {
    function lucide_icon(string $icon, string $className = ''): string
    {
        $icons = [
            'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
            'book-open' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
            'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
            'code' => '<path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/><path d="m14.5 4-5 16"/>',
            'layers' => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5"/><path d="m3 16 9 5 9-5"/>',
            'monitor' => '<rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>',
            'package' => '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>',
            'rocket' => '<path d="M4.5 16.5c-1.5 1.5-2 4.5-2 4.5s3-.5 4.5-2c1-1 1-2.5 0-3.5s-2.5-1-3.5 0Z"/><path d="M10 14 20 4"/><path d="M9 15c-1.5-4.5 1.5-9 5-11 2.5 0 4.5 2 4.5 4.5-2 3.5-6.5 6.5-11 5Z"/><path d="M15 9h.01"/>',
            'signpost' => '<path d="M12 13v8"/><path d="M12 3v3"/><path d="M18 6H8l-2 3 2 3h10l2-3Z"/><path d="M6 12H4l-2 3 2 3h8"/>',
            'sparkles' => '<path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5Z"/><path d="M5 3v4"/><path d="M3 5h4"/><path d="M19 16v5"/><path d="M16.5 18.5h5"/>',
            'terminal' => '<path d="M4 17 10 11 4 5"/><path d="M12 19h8"/>',
            'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        ];

        $paths = $icons[$icon] ?? $icons['code'];
        $class = $className !== '' ? ' ' . $className : '';

        return '<svg class="icon' . $class . '" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">' . $paths . '</svg>';
    }
}

if (!function_exists('site_url')) {
    function site_url(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';

        if ($host === '') {
            return '';
        }

        $scheme = 'http';

        if (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        ) {
            $scheme = 'https';
        }

        return $scheme . '://' . $host;
    }
}