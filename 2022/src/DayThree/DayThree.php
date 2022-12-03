<?php

namespace Illizian\AdventOfCode2022\DayThree;

use Illuminate\Support\Collection;

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

  public static function PartTwo(string $input): int
  {
    $values = [null, ...range('a', 'z'), ...range('A', 'Z')];

    return collect(explode("\n", $input))
      ->chunk(3)
      ->map(fn (Collection $group) => $group->map(fn (string $backpack) => collect(str_split($backpack, 1))))
      ->map(function (Collection $group) {
        [$first, $second, $third] = $group->values();

        return $first
          ->filter(fn ($item) => $second->contains($item))
          ->filter(fn ($item) => $third->contains($item))
          ->first();
        return $group;
      })
      ->filter()
      ->map(fn (string $badge) => array_search($badge, $values))
      ->sum();
  }
}
