<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illuminate\Support\Collection;

class DayFourteenPartOne
{
    public static function process(array $input, int $steps = 10): int
    {
        $template = $input[0];
        
        $rules = collect(array_slice($input, 2))
            ->mapWithKeys(function(string $rule) {
                list($key, $val) = explode(' -> ', $rule);

                return [ $key => $val ];
            });

        // Create an array for each step, and return the final transmutation
        $polymer = collect(range(1, $steps))
            // Reduce the steps into a final Polymer
            ->reduce(function(string $polymer, $step) use ($rules) {
                dump($step);
                // Split the current $polymer
                return collect(str_split($polymer))
                    // Create a sliding array of the pairs
                    ->sliding()
                    // Reduce this to our new string containing the injected elements from the $rules
                    ->reduce(function(string $current, Collection $pairs) use ($rules) {
                        $key = $pairs->join('');
                        if (! $rules->has($key)) {
                            throw new Exception("Rule does not exist for this pair [$key]");
                        }

                        // Insert the new character in the middle
                        $pairs->splice(1, 0, $rules->get($key));

                        // Return the current string with the new injected string appended
                        return (
                            $current === ''
                                ? $pairs
                                : $pairs->splice(1)->prepend($current)
                        )->join('');
                    }, '');
            }, $template);

        $counts = collect(str_split($polymer))
            ->groupBy(fn($char) => $char)
            ->map->count()
            ->sortDesc();

        return $counts->first() - $counts->last();
    }
}