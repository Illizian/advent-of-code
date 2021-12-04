<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayOnePartOne
{
    public static function process(array $input): int
    {
        $result = Collection::make($input)
            ->map(fn($value) => (int) $value)
            ->reduce(function($carry, $value) {
                if ($carry === null) {
                    return [0, $value];
                }
                
                return [
                    $value > $carry[1]
                        ? $carry[0] + 1
                        : $carry[0],
                    $value
                ];
            });

        return $result[0];
    }
}