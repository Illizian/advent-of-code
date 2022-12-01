<?php

namespace Illizian\AdventOfCode2022\DayOne;

class DayOne
{
  public static function PartOne(string $input): int
  {
    return collect(explode("\n\n", $input))
      ->map(fn (string $list) => explode("\n", $list))
      ->map(fn (array $list) => array_reduce($list, fn (int $total, string $item) => $total + (int) $item, 0))
      ->sortDesc()
      ->first();
  }

  public static function PartTwo(string $input): int
  {
    return collect(explode("\n\n", $input))
      ->map(fn (string $list) => explode("\n", $list))
      ->map(fn (array $list) => array_reduce($list, fn (int $total, string $item) => $total + (int) $item, 0))
      ->sortDesc()
      ->take(3)
      ->reduce(fn (int $total, int $calories) => $total + $calories, 0);
  }
}
