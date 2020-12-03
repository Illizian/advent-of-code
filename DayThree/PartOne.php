<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$matrix = array_map(fn($row) => str_split($row), explode("\n", $file));
$height = count($matrix);
$width = count($matrix[0]);

$position = [0,0];
$trees = 0;

while ($position[0] < $height) {
  if ($matrix[ $position[0] ][ $position[1] ] === '#') {
    $trees++;
  }

  $position = [
    $position[0] + 1,
    ($position[1] + 3) % $width
  ];
}

echo "Your answer is: $trees\n";
