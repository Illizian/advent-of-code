<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayFivePartOne
{ 
    public static function process(array $input): int
    {
        return Collection::make(
            array_map(
                fn($row) => array_map(fn($coords) => explode(',', $coords), explode(' -> ', $row)),
                $input
            )
        )
            ->filter(fn($coords) => (
                // If x1 != x2 || y1 != y2, then remove
                $coords[0][0] === $coords[1][0] ||
                $coords[0][1] === $coords[1][1]
            ))
            ->transform(function($coords) {
                // Direction: 0 = X // 1 = Y
                $dir = +($coords[0][0] === $coords[1][0]);
                $length = abs($coords[0][$dir] - $coords[1][$dir]) + 1;
                if ($length <= 2) return $coords;
                
                $start = intval($coords[+($coords[0][$dir] > $coords[1][$dir])][$dir]);
                $fill = array_fill(0, $length, null);

                return array_map(
                    fn($key) => [
                        ($dir === 0) ? $start + $key : intval($coords[0][0]),
                        ($dir === 1) ? $start + $key : intval($coords[0][1]),
                    ],
                    array_keys($fill),
                    $fill
                );
            })
            ->flatten(1)
            ->transform(fn($coords) => "{$coords[0]} x {$coords[1]}")
            ->groupBy(fn($str) => $str)
            ->map
            ->count()
            ->filter(fn($val) => $val > 1)
            ->count();
    }
}