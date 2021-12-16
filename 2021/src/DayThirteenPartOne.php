<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayThirteenPartOne
{
    public static function process(array $input): int
    {
        return self::fold($input, 1)->count();
    }

    public static function fold(
        array $input,
        int $limit = 1,
    ): Collection {
        $splice = array_search('', $input);
        $points = collect(array_splice($input, 0, $splice))
            ->transform(fn(string $coords) => array_map(
                fn($val) => intval($val),
                explode(',', $coords)
            ));
        $instructions = collect(array_splice($input, 1));

        return $instructions
            ->when($limit > 0, fn($instructions) => $instructions->take($limit))
            ->reduce(
                function(Collection $points, string $instruction) {
                    [ $dir, $len ] = explode('=', str_replace('fold along ', '', $instruction));

                    return $points
                        // Filter the line we're mirroring
                        ->filter(fn($coords) => $dir === 'x' ? ($coords[0] !== $len) : ($coords[1] !== $len))
                        // Transpose $coords outside bounds into the bounds
                        ->transform(fn($coords) => [
                            // If we're flipping X, and the current X is outside - transpose
                            ($dir === 'x' && $coords[0] > $len)
                                ? $len - ($coords[0] - $len)
                                : $coords[0],
                            // If we're flipping Y, and the current Y is outside - transpose
                            ($dir === 'y' && $coords[1] > $len)
                                ? $len - ($coords[1] - $len)
                                : $coords[1]
                        ]);
                },
                $points
            )
            ->unique();
    }
}