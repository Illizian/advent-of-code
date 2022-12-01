<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DaySevenPartOne
{
    public static function process(array $input): int
    {
        $crabs = collect(explode(',', $input[0]));

        // return collect($crabs->mode())
        //     ->transform(fn(int $mode) => $crabs->sum(fn(int $pos) => abs($pos - $mode)))
        //     ->sortDesc()
        //     ->first();

        return 
            // collect($crabs->mode())
            // @TODO: Mode doesn't work for the actual input, find a better way than brute force unique below
            $crabs->unique()
                ->transform(fn(int $mode) => $crabs->sum(fn(int $pos) => abs($pos - $mode)))
                ->sort()
                ->first();
    }
}