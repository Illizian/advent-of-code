<?php

use Illizian\AdventOfCode\DayFivePartOne;
use Illizian\AdventOfCode\DayFivePartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayFivePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-five-example.txt')
        )
    )->toEqual(5);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayFivePartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-five-example.txt')
        )
    )->toEqual(12);
});

it('can process the first puzzle input', function() {
    expect(
        DayFivePartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-five.txt')
        )
    )->toEqual(4993);
});

it('can process the second puzzle input', function() {
    expect(
        DayFivePartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-five.txt')
        )
    )->toEqual(21101);
});
