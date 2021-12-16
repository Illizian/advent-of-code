<?php

use Illizian\AdventOfCode\DaySix;
use Illizian\AdventOfCode\Helpers\Loader;

it('can process the example input for part one and return the provided answer', function () {
    expect(
        DaySix::process(
            Loader::load(__DIR__ . '/fixtures/day-six-example.txt'),
            18
        )
    )->toEqual(26);

    expect(
      DaySix::process(
          Loader::load(__DIR__ . '/fixtures/day-six-example.txt'),
          80
      )
  )->toEqual(5934);
});

it('can process the example input for part two and return the provided answer', function () {
    expect(
        DaySix::process(
            Loader::load(__DIR__ . '/fixtures/day-six-example.txt'),
            256
        )
    )->toEqual(26984457539);
});

it('can process the first puzzle input', function() {
    expect(
        DaySix::process(
            Loader::load(__DIR__ . '/fixtures/day-six.txt'),
            80
        )
    )->toEqual(380612);
});

it('can process the second puzzle input', function() {
    expect(
        DaySix::process(
            Loader::load(__DIR__ . '/fixtures/day-six.txt'),
            256
        )
    )->toEqual(1710166656900);
});
