<?php

use Illizian\AdventOfCode\DayEightPartOne;
use Illizian\AdventOfCode\DayEightPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    ray()->clearAll();
    expect(
        DayEightPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-eight-example.txt')
        )
    )->toEqual(26);
});

// it('can process the example input for part two and return the provided answer', function () {
//     expect(
//         DayEightPartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-eight-example.txt')
//         )
//     )->toEqual(12);
// });

it('can process the first puzzle input', function() {
    expect(
        DayEightPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-eight.txt')
        )
    )->toEqual(375);
});

// it('can process the second puzzle input', function() {
//     expect(
//         DayEightPartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-eight.txt')
//         )
//     )->toEqual(21101);
// });
