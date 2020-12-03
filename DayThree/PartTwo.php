<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$matrix = array_map(fn($row) => str_split($row), explode("\n", $file));

function check($matrix, $right, $down) {
  $height = count($matrix);
  $width = count($matrix[0]);
  $position = [0,0];
  $trees = 0;

  while ($position[0] < $height) {
    if ($matrix[ $position[0] ][ $position[1] ] === '#') {
      $trees++;
    }

    $position = [
      $position[0] + $down,
      ($position[1] + $right) % $width
    ];
  }

  return $trees;
}

$total = array_reduce(
  [ [1, 1], [3, 1], [5, 1], [7, 1], [1, 2] ],
  fn($count, $iteration) => $count > 0
    ? $count * check($matrix, $iteration[0], $iteration[1])
    : check($matrix, $iteration[0], $iteration[1]),
  0
);

echo "Your answer is: $total\n";