<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illuminate\Support\Collection;

class DayTwoPartTwo
{
    public static function process(array $input): int
    {
        $result = Collection::make($input)
            ->reduce(function($carry, $value) {
                [ $horizontal, $depth, $aim ] = $carry ?? [0, 0, 0];
                [ $direction, $distance ] = explode(' ', $value);

                return match ($direction) {
                    'forward' => [ $horizontal + $distance, $depth + ($aim * $distance), $aim ],
                    'up' => [ $horizontal, $depth, $aim - $distance ],
                    'down' => [ $horizontal, $depth, $aim + $distance ],
                    default => throw new Exception("Unrecognized direction [$direction]")
                };
            });

        return $result[0] * $result[1];
    }
}