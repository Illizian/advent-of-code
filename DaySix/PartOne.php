<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$output = array_reduce(
  array_map(
    fn($group) => count(array_unique($group)),
    array_map(
      fn($group) => array_filter(
        str_split($group),
        fn($char) => $char !== "\n"
      ),
      explode("\n\n", $file)
    )
  ),
  fn($total, $group) => $total + $group,
  0
);

var_dump($output);
