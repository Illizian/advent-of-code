<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DaySix
{
    public static function process(array $input, int $generations): int
    {
        $initial = collect(explode(',', $input[0]))
            ->groupBy(fn(string $timer) => (int) $timer)
            ->map->count();

        $fish = collect(array_fill(0, 9, 0))->replace($initial);

        return collect(range(1, $generations))
            ->reduce(function(Collection $fish, int $generation) {
                // Take the spawning fish
                $spawning = $fish->shift();
                
                // Add the spawning fish to the current first gen
                $fish[6] += $spawning;

                // Return the new collection of fish with the babies appended
                return $fish->push($spawning);
            }, $fish)
            ->sum();
    }
}