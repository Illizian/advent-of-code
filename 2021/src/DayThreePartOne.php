<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

Collection::macro('transpose', function () {
    $items = array_map(function (...$items) {
        return $items;
    }, ...$this->values());

    return new static($items);
});

class DayThreePartOne
{
    public static function process(array $input): int
    {
        [ $gamma, $epsilon ] = Collection::make($input)
            ->map(fn($row) => str_split($row))
            ->transpose()
            ->map(fn($bits) => collect($bits)->mode()[0])
            ->reduceSpread(
                fn($gamma, $epsilon, $bit) => [
                    $gamma . $bit,
                    $epsilon . ($bit ^= 1),
                ],
                '',
                ''
            );
        
        // LOL! PHP has some of the greatest names :{}
        return bindec($gamma) * bindec($epsilon);
    }
}