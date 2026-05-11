<?php

declare(strict_types=1);

namespace LimaSite\Modules;

class JsonContentLoader {
    public static function Load(string $page, string $name): mixed {
        $filePath = LIMA_ROOT . "/static/content/{$page}/{$name}.json";

        if (!file_exists($filePath)) {
            return false;
        }

        $jsonContents = file_get_contents($filePath);

        if (!json_validate($jsonContents)) {
            return false;
        }

        return json_decode($jsonContents, true);
    }
}