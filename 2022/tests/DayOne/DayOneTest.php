<?php

use Illizian\AdventOfCode2022\DayOne\DayOne;

it('processes the Part One input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayOne::PartOne($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 24000],
  ['/input-part1.txt', 69281],
]);

it('processes the Part Two input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayOne::PartTwo($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 45000],
  ['/input-part1.txt', 201524],
]);
