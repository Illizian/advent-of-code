<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illizian\AdventOfCode\Helpers\Matrix;
use Illuminate\Support\Collection;

class DayNinePartOne
{
    public static function process(array $input): int
    {
        $matrix = Matrix::make(
            array_map(
                fn($row) => array_map(fn($height) => intval($height), str_split($row)),
                $input
            )
        );

        ray($matrix);

        return $matrix->cells()
            ->reduce(
                fn(int $total, int $height, int $pos) =>
                    $total + static::getCellRisk($matrix, $pos, $height),
                0
            )
        // return $grid->reduce(
        //     fn(int $total, Collection $columns, int $y) => (
        //         $total + $columns->reduce(
        //             fn(int $subtotal, int $height, int $x) => (
        //                 $subtotal + static::getCellRisk($grid, $height, $x, $y)
        //             ),
        //             0
        //         )
        //     ),
        //     0
        // );
    }

    protected static function getCellRisk(
        Matrix $matrix,
        int $height,
        int $pos
    ): int {
        [ $up, $right, $down, $left ] = $matrix->getNeighbors($grid, $x, $y);

        if ($up > $height && $right > $height && $down > $height && $left > $height) {
            return $height + 1;
        }

        return 0;
    }

    // protected static function getNeighbors(Collection $grid, int $x, int $y, int $default = PHP_INT_MAX):  array
    // {
    //     return [
    //         $grid->get($y - 1, collect())->get($x, $default), // up
    //         $grid->get($y, collect())->get($x + 1, $default), // right
    //         $grid->get($y + 1, collect())->get($x, $default), // down
    //         $grid->get($y, collect())->get($x - 1, $default), // left
    //     ];
    // }
}