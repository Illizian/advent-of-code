<?php

namespace Illizian\AdventOfCode2022\DayFour;

use Illuminate\Support\Collection;

class DayFour
{
  public static function PartOne(string $input): int
  {
    return collect(explode("\n", $input))
      ->map(fn (string $instructions) => explode(",", $instructions))
      ->map(fn (array $assignments) => array_map(fn (string $assignment) => explode('-', $assignment), $assignments))
      ->filter(function (array $assignments) {
        [$one, $two] = $assignments;
        [$one_lower, $one_upper] = $one;
        [$two_lower, $two_upper] = $two;

        return (
          ($one_lower >= $two_lower && $one_upper <= $two_upper) ||
          ($two_lower >= $one_lower && $two_upper <= $one_upper)
        );
      })
      ->count();
  }

  public static function PartTwo(string $input): int
  {
    return collect(explode("\n", $input))
      ->map(fn (string $instructions) => explode(",", $instructions))
      ->map(fn (array $assignments) => array_map(fn (string $assignment) => explode('-', $assignment), $assignments))
      ->filter(function (array $assignments) {
        [$one, $two] = $assignments;
        [$one_lower, $one_upper] = $one;
        [$two_lower, $two_upper] = $two;

        return (
          ($one_lower >= $two_lower && $one_lower <= $two_upper) ||
          ($one_upper >= $two_lower && $one_upper <= $two_upper) ||
          ($two_lower >= $one_lower && $two_lower <= $one_upper) ||
          ($two_upper >= $one_lower && $two_upper <= $one_upper)
        );
      })
      ->count();
  }
}
