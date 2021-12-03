<?php

$input = array_map(fn($instruction) => [
  substr($instruction, 0, 1),
  substr($instruction, 1)
], explode("\n", file_get_contents(__DIR__ . '/input.txt')));

$directions = "NESW";
$direction = "E";

function ChangeDirection(string $rotate, int $degress) {
  $cardinals = ($degrees / 90 ) * $rotate = "L" ? -1 : 1;
  // $direction = $directions[ (strpos($directions, $direction) + $cardinals) % count($directions) ];

  return $cardinals;
}

var_dump(ChangeDirection("R", 180));
var_dump($direction);
// var_dump(ChangeDirection("R", 180));
