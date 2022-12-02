<?php

namespace Illizian\AdventOfCode2022\DayTwo;

class DayTwo
{
  public static $value = [
    'Rock' => 1,
    'Paper' => 2,
    'Scissors' => 3,
  ];

  public static $rules = [
    'Rock' => 'Scissors',
    'Scissors' => 'Paper',
    'Paper' => 'Rock'
  ];

  public static $score = [
    'Win' => 6,
    'Draw' => 3,
    'Loss' => 0,
  ];

  public static function stringToEntity(string $char): string
  {
    return match ($char) {
      'A', 'X' => 'Rock',
      'B', 'Y' => 'Paper',
      'C', 'Z' => 'Scissors',
    };
  }

  public static function getRoundScore(array $match): int
  {
    [$opponent, $player] = $match;

    $score = self::getMatchScore($opponent, $player);

    return $score + self::$value[$player];
  }

  public static function getMatchScore(string $opponent, string $player): int
  {
    if ($opponent === $player) return self::$score['Draw'];

    return self::$rules[$player] === $opponent
      ? self::$score['Win']
      : self::$score['Loss'];
  }

  public static function PartOne(string $input): int
  {
    return collect(explode("\n", $input))
      ->map(fn ($round) => explode(" ", $round))
      ->map(fn ($round) => [
        self::stringToEntity($round[0]),
        self::stringToEntity($round[1]),
      ])
      ->map(fn ($round) => self::getRoundScore($round))
      ->sum();
  }
}
