<?php

use Illizian\AdventOfCode\DaySevenPartOne;
use Illizian\AdventOfCode\DaySevenPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DaySevenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-seven-example.txt')
        )
    )->toEqual(37);
});

// it('can process the example input for part two and return the provided answer', function () {
//     expect(
//         DaySevenPartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-seven-example.txt')
//         )
//     )->toEqual(168);
// });

it('can process the first puzzle input', function() {
    expect(
        DaySevenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-seven.txt')
        )
    )->toEqual(325528);
});

// it('can process the second puzzle input', function() {
//     expect(
//         DaySevenPartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-seven.txt')
//         )
//     )->toEqual(9576);
// });
