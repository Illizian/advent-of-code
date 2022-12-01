<?php

namespace Illizian\AdventOfCode2022\DayOne;

use Illuminate\Support\Collection;

class DayOne
{
  protected static function parse(string $input): Collection
  {
    return collect(explode("\n\n", $input))
      ->map(fn (string $list) => explode("\n", $list))
      ->map(fn (array $list) => array_reduce($list, fn (int $total, string $item) => $total + (int) $item, 0))
      ->sortDesc();
  }

  public static function PartOne(string $input): int
  {
    return self::parse($input)->first();
  }

  public static function PartTwo(string $input): int
  {
    return self::parse($input)
      ->take(3)
      ->reduce(fn (int $total, int $calories) => $total + $calories, 0);
  }
}
