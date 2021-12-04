<?php

use Illizian\AdventOfCode\Helpers\Loader;

it('can load an input file and returns the expected output', function () {
    expect(Loader::load(__DIR__ . '/fixtures/input.txt'))
        ->toBeArray()
        ->toHaveLength(5);
});
