<?php

use Illizian\AdventOfCode\DayThreePartOne;
use Illizian\AdventOfCode\DayThreePartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayThreePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-three-example.txt')
        )
    )->toEqual(198);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayThreePartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-three-example.txt')
        )
    )->toEqual(230);
});

it('can process the first puzzle input', function() {
    expect(
        DayThreePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-three.txt')
        )
    )->toEqual(2250414);
});

it('can process the second puzzle input', function() {
    expect(
        DayThreePartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-three.txt')
        )
    )->toEqual(6085575);
});
