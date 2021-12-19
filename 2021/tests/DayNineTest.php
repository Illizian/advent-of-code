<?php

use Illizian\AdventOfCode\DayNinePartOne;
use Illizian\AdventOfCode\DayNinePartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    ray()->clearAll();
    expect(
        DayNinePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-nine-example.txt')
        )
    )->toEqual(15);
});

// it('can process the example input for part two and return the provided answer', function () {
//     expect(
//         DayNinePartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-nine-example.txt')
//         )
//     )->toEqual(1134);
// });

it('can process the first puzzle input', function() {
    expect(
        DayNinePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-nine.txt')
        )
    )->toEqual(537);
});

// it('can process the second puzzle input', function() {
//     expect(
//         DayNinePartTwo::process(
//             Loader::load(__DIR__ . '/fixtures/day-nine.txt')
//         )
//     )->toEqual(21101);
// });
