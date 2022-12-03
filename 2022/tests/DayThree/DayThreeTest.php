<?php

use Illizian\AdventOfCode2022\DayThree\DayThree;

it('processes the Part One input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayThree::PartOne($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 157],
  ['/input-part1.txt', 7793],
]);

it('processes the Part Two input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayThree::PartTwo($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 70],
  ['/input-part1.txt', 2499],
]);
