<?php

use Illizian\AdventOfCode\DayTwoPartOne;
use Illizian\AdventOfCode\DayTwoPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayTwoPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-two-example.txt')
        )
    )->toEqual(150);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayTwoPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-two-example.txt')
        )
    )->toEqual(900);
});

it('can process the first puzzle input', function() {
    expect(
        DayTwoPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-two.txt')
        )
    )->toEqual(1938402);
});

it('can process the second puzzle input', function() {
    expect(
        DayTwoPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-two.txt')
        )
    )->toEqual(1947878632);
});
