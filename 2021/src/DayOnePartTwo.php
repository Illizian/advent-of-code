<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayOnePartTwo
{
    public static function process(array $input): int
    {
        return DayOnePartOne::process(
            Collection::make($input)
                ->map(fn($value) => (int) $value)
                ->sliding(3)
                ->map->sum()
                ->toArray()
        );
    }
}