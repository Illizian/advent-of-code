<?php

use Illizian\AdventOfCode\DayFourPartOne;
use Illizian\AdventOfCode\DayFourPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayFourPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-four-example.txt')
        )
    )->toEqual(4512);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayFourPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-four-example.txt')
        )
    )->toEqual(1924);
});

it('can process the first puzzle input', function() {
    expect(
        DayFourPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-four.txt')
        )
    )->toEqual(8580);
});

it('can process the second puzzle input', function() {
    expect(
        DayFourPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-four.txt')
        )
    )->toEqual(9576);
});
