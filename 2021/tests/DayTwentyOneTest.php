<?php

use Illizian\AdventOfCode\DayTwentyOnePartOne;
use Illizian\AdventOfCode\DayTwentyOnePartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayTwentyOnePartOne::make(Loader::load(__DIR__ . '/fixtures/day-twentyone-example.txt'))
            ->process()
    )->toEqual(739785);
});

// it('can process the example input for part two and return the provided answer', function () {
//     expect(
//         DayTwentyOnePartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-twentyone-example.txt')
//         )
//     )->toEqual(168);
// });

it('can process the first puzzle input', function() {
    expect(
        DayTwentyOnePartOne::make(Loader::load(__DIR__ . '/fixtures/day-twentyone.txt'))
            ->process()
    )->toEqual(503478);
});

// it('can process the second puzzle input', function() {
//     expect(
//         DayTwentyOnePartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-twentyone.txt')
//         )
//     )->toEqual(9576);
// });
