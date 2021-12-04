<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode\Helpers;

class Loader
{
    public static function load(string $path): array
    {
        return explode("\n", file_get_contents($path));
    }
}