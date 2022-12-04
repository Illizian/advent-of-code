<?php

use Illizian\AdventOfCode2022\DayFour\DayFour;

it('processes the Part One input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayFour::PartOne($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 2],
  ['/input-part1.txt', 494],
]);

it('processes the Part Two input, and provides the expected output', function ($file, $expected) {
  $input = file_get_contents(__DIR__ . $file);

  $output = DayFour::PartTwo($input);

  expect($output)->toEqual($expected);
})->with([
  ['/input-example.txt', 4],
  ['/input-part1.txt', 833],
]);
