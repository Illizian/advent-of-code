<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayEightPartOne
{
    public static function process(array $input): int
    {
        /**
         * digit 0 = 6 segments
         * digit 1 = 2 segments **
         * digit 2 = 5 segments
         * digit 3 = 5 segments
         * digit 4 = 4 segments **
         * digit 5 = 5 segments
         * digit 6 = 6 segments
         * digit 7 = 3 segments **
         * digit 8 = 7 segments **
         * digit 9 = 6 segments
         */
        return collect($input)
            ->transform(fn(string $line) => explode(' | ', $line)[1])
            ->transform(fn(string $line) => explode(' ', $line))
            ->transform(fn(array $segments) => array_reduce(
                $segments,
                fn(int $sum, string $segment) => match(strlen($segment)) {
                    // digit:segments
                    // 1:2, 4:4, 7:3, 8:7
                    2, 4, 3, 7 => $sum + 1,
                    default => $sum,
                },
                0
            ))
            ->sum();
    }
} 