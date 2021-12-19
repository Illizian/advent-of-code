<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayTenPartTwo
{
    protected static array $values = [
        ')' => 1,
        ']' => 2,
        '}' => 3,
        '>' => 4,
    ];

    public static function process(array $input): int
    {
        $scores = collect($input)
            ->map(fn(string $line) => DayTenPartOne::validLine($line))
            ->filter(fn(array|string $valid) => is_array($valid))
            ->map(fn(array $bag) => array_reverse(
                array_map(
                    fn($token) => DayTenPartOne::$tokens[$token],
                    $bag
                )
            ))
            ->map(fn(array $bag) => array_reduce(
                $bag,
                fn(int $sum, string $token) => ($sum * 5) + static::$values[$token],
                0
            ))
            ->sort();

        // Calculate the middle, docs note there will always
        // be an odd number of elements
        $middle = floor($scores->count() / 2);
        
        // Using array_values to re-index the Collection, so we 
        // can select the middle
        return array_values($scores->toArray())[$middle];
    }
}