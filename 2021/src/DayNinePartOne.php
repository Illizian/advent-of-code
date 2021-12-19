<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayNinePartOne
{
    public static function process(array $input): int
    {
        $grid = collect($input)->map(
            fn(string $cols) => collect(str_split($cols))->transform(fn(string $str) => intval($str))
        );

        return $grid->reduce(
            fn(int $total, Collection $columns, int $y) => (
                $total + $columns->reduce(
                    fn(int $subtotal, int $height, int $x) => (
                        $subtotal + static::getCellRisk($grid, $height, $x, $y)
                    ),
                    0
                )
            ),
            0
        );
    }

    protected static function getCellRisk(
        Collection $grid,
        int $height,
        int $x,
        int $y
    ): int {
        [ $up, $right, $down, $left ] = static::getNeighbors($grid, $x, $y);

        if ($up > $height && $right > $height && $down > $height && $left > $height) {
            return $height + 1;
        }

        return 0;
    }

    protected static function getNeighbors(Collection $grid, int $x, int $y, int $default = PHP_INT_MAX):  array
    {
        return [
            $grid->get($y - 1, collect())->get($x, $default), // up
            $grid->get($y, collect())->get($x + 1, $default), // right
            $grid->get($y + 1, collect())->get($x, $default), // down
            $grid->get($y, collect())->get($x - 1, $default), // left
        ];
    }
}