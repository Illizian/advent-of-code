<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$ids = array_map(function ($line) {
  $row = range(0, 127);
  $col = range(0, 7);
  [ $rowIndex, $colIndex ] = str_split($line, 7);

  foreach (str_split($rowIndex) as $key => $index) {
    [ $lower, $upper ] = array_chunk($row, count($row) / 2);

    $row = ($index === 'F') ? $lower : $upper;
  }

  foreach (str_split($colIndex) as $key => $index) {
    [ $lower, $upper ] = array_chunk($col, count($col) / 2);

    $col = ($index === 'L') ? $lower : $upper;
  }

  return ($row[0] * 8) + $col[0];
}, explode("\n", $file));

var_dump(array_reduce($ids, fn($acc, $id) => $id > $acc ? $id : $acc));