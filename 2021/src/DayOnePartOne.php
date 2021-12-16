<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayOnePartOne
{
    public static function process(array $input): int
    {
        return Collection::make($input)
            ->transform(fn($val) => (int) $val)
            ->sliding(2)
            ->reduce(fn(int $sum, Collection $items) => +($items->last() > $items->first()) + $sum, 0);
    }
}