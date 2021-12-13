<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayFivePartTwo
{
    public static function process(array $input): int
    {
        return Collection::make(
            array_map(
                fn($row) => array_map(fn($coords) => explode(',', $coords), explode(' -> ', $row)),
                $input
            )
        )
            ->map(function($coords) {
                [ [ $x1, $y1 ], [ $x2, $y2 ] ] = $coords;
                $dir = [
                    ($x1 === $x2) ? 0 : ($x1 > $x2 ? -1 : 1),
                    ($y1 === $y2) ? 0 : ($y1 > $y2 ? -1 : 1)
                ];
                $len = ($y1 === $y2)
                    ? abs($x1 - $x2)
                    : abs($y1 - $y2);
                $fill = array_fill(0, $len + 1, null);

                return array_map(
                    fn($key) => [
                        intval($x1) + ($key * $dir[0]),
                        intval($y1) + ($key * $dir[1]),
                    ],
                    array_keys($fill),
                    $fill
                );
            })
            ->flatten(1)
            ->map(fn($coords) => "{$coords[0]} x {$coords[1]}")
            ->groupBy(fn($str) => $str)
            ->map
            ->count()
            ->filter(fn($val) => $val > 1)
            ->count();
    }
}