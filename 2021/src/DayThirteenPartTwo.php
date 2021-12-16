<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayThirteenPartTwo
{
    public static function process(array $input): string
    {
        $folded = DayThirteenPartOne::fold($input, 0);
        [ $cols, $rows ] = $folded->reduce(fn(array $max, array $coords) => [
            $coords[0] > $max[0] ? $coords[0] : $max[0],
            $coords[1] > $max[1] ? $coords[1] : $max[1]
        ], [ 0, 0 ]);

        $grid = $folded->reduce(
            function(array $grid, array $coords) {
                [ $x, $y ] = $coords;
                $grid[$y][$x] = '#';

                return $grid;
            },
            // Generate a 2D grid of dots to begin with
            array_map(
                fn() => array_fill(0, $cols + 1, '.'),
                array_fill(0, $rows + 1, null)
            )
        );

        // Return as a string representation of the grid
        return implode("\n", array_map(fn($row) => implode('', $row), $grid));
    }
}