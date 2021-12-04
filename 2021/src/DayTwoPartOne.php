<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illuminate\Support\Collection;

class DayTwoPartOne
{
    public static function process(array $input): int
    {
        $result = Collection::make($input)
            ->reduce(function($carry, $value) {
                [ $horizontal, $depth ] = $carry ?? [0, 0];
                [ $direction, $distance ] = explode(' ', $value);

                return match ($direction) {
                    'forward' => [ $horizontal + $distance, $depth ],
                    'up' => [ $horizontal, $depth - $distance ],
                    'down' => [ $horizontal, $depth + $distance ],
                    default => throw new Exception("Unrecognized direction [$direction]")
                };
            });

        return $result[0] * $result[1];
    }
}