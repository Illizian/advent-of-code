<?php

use Illizian\AdventOfCode2022\DayTwo\DayTwo;

it('processes the Part One input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayTwo::PartOne($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 15],
  ['/input-part1.txt', 11475],
]);
