<?php

use Illizian\AdventOfCode\DayTenPartOne;
use Illizian\AdventOfCode\DayTenPartTwo;
use Illizian\AdventOfCode\Helpers\Loader;

it('can identify an invalid line and return the incorrect token', function($line, $token) {
    expect(DayTenPartOne::validLine($line))->toEqual($token);
})->with([
    [ '{([(<{}[<>[]}>{[]{[(<()>', '}' ],
    [ '[[<[([]))<([[{}[[()]]]', ')' ],
    [ '[{[{({}]{}}([{[{{{}}([]', ']' ],
    [ '[<(<(<(<{}))><([]([]()', ')' ],
    [ '<{([([[(<>()){}]>(<<{{', '>' ],
]);


it('can process the example input for part one and return the provided answer', function () {
    expect(
        DayTenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-ten-example.txt')
        )
    )->toEqual(26397);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DayTenPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-ten-example.txt')
        )
    )->toEqual(288957);
});

it('can process the first puzzle input', function() {
    expect(
        DayTenPartOne::process(
            Loader::load(__DIR__ . '/fixtures/day-ten.txt')
        )
    )->toEqual(464991);
});

it('can process the second puzzle input', function() {
    expect(
        DayTenPartTwo::process(
            Loader::load(__DIR__ . '/fixtures/day-ten.txt')
        )
    )->toEqual(3662008566);
});
