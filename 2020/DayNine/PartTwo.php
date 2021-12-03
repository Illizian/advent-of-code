<?php

$input = array_map('intval', explode("\n", file_get_contents(__DIR__ . '/input.txt')));
$seek = 32321523;
$numbers = [];

$seeking = true;
$index = 0;
$length = 0;

while($seeking) {
  $sum = array_sum($numbers);

  if ($sum === $seek) {
    $seeking = false;
  } elseif ($sum > $seek) {
    $index++;
    $length--;
  } else {
    $length++;
  }

  $numbers = array_slice($input, $index, $length);
}

var_dump(min($numbers) + max($numbers));