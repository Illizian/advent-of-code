<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$operations = array_map(fn($operation) => explode(' ', $operation), explode("\n", $file));
$path = [];
$index = 0;
$running = true;
$acc = 0;

while ($running) {
  $path[] = $index;
  [ $op, $param ] = $operations[$index];

  switch ($op) {
    case 'acc':
      $acc = $acc + (int) $param;
      $index++;
      break;
    case 'jmp':
      $index = $index + (int) $param;
      break;
    case 'nop':
      $index++;
      break;
  }

  $running = (
    !in_array($index, $path) &&
    $index >= 0 &&
    $index <= count($operations)
  );
}

if ($index >= count($operations)) {
  echo "Programme Completed\n";
} else {
  echo "Programme Terminated Early\n";
}

var_dump($index, count($operations));
var_dump($acc);
// var_dump($index, $path);
// echo "Accumulator at: $acc\n";