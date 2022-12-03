<?php

namespace Illizian\AdventOfCode2022\DayThree;

class DayThree
{
  public static function PartOne(string $input): int
  {
    $values = [null, ...range('a', 'z'), ...range('A', 'Z')];

    return collect(explode("\n", $input))
      ->map(fn (string $backpack) => str_split($backpack, floor(strlen($backpack) / 2)))
      ->map(function (array $comparments) {
        $first = collect(str_split($comparments[0], 1));
        $second = collect(str_split($comparments[1], 1));

        return $first
          ->unique()
          ->filter(fn ($item) => $second->contains($item))
          ->first();
      })
      ->filter()
      ->map(fn (string $duplicate) => array_search($duplicate, $values))
      ->sum();
  }
}
