<?php

use Illizian\AdventOfCode\DayThirteenPartOne;
use Illizian\AdventOfCode\DayThirteenPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayThirteenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-thirteen-example.txt')
        )
    )->toEqual(17);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayThirteenPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-thirteen-example.txt')
        )
    )->toEqual(
        <<<STRING
        #####
        #...#
        #...#
        #...#
        #####
        STRING
    );
});

it('can process the first puzzle input', function() {
    expect(
        DayThirteenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-thirteen.txt')
        )
    )->toEqual(942);
});

it('can process the second puzzle input', function() {
    expect(
        DayThirteenPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-thirteen.txt')
        )
    )->toEqual(
        <<<STRING
        ..##.####..##..#..#..##..###..###..###.
        ...#....#.#..#.#..#.#..#.#..#.#..#.#..#
        ...#...#..#....#..#.#..#.#..#.#..#.###.
        ...#..#...#.##.#..#.####.###..###..#..#
        #..#.#....#..#.#..#.#..#.#....#.#..#..#
        .##..####..###..##..#..#.#....#..#.###.
        STRING
    );
});
