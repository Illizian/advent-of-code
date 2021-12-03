<?php

$input = array_map('intval', explode("\n", file_get_contents(__DIR__ . '/input.txt')));
$preamble = 25;

function SumCheck($sum, $ints) {
  foreach($ints as $index => $a) {
    foreach($ints as $bIndex => $b) {
      if ($index === $bIndex) continue;
      if ($a + $b === $sum) return true;
    }
  }

  return false;
}


foreach (range($preamble, count($input)-1) as $index) {
  $number = $input[$index];
  $previous = array_slice($input, $index - $preamble, $preamble);

  if (! SumCheck($number, $previous)) {
    echo "SumCheck failed\n";
    var_dump($number, $previous);
    break;
  }
}