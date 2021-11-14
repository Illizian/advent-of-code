<?php

$file = file_get_contents(__DIR__ . '/input.txt');

function sanitise_bag_input($string)
{
  // Extracts the colour attribute from a string, e.g:
  //   `4 muted yellow bags.`  =>  `4 (muted yellow) bags.`  =  "muted yellow"
  //   `1 dark olive bag`      =>  `1 (dark olive) bag.`     =  "dark olive"
  //   `faded blue bags`       =>  `(faded blue) bags        =  "faded blue"
  return preg_replace('/(\d{1,}\s)?(.*)(\sbags?.?)/', '$2', $string);
}

function count_bags_contain($bags, $contain)
{
  return array_reduce($bags, fn($count, $bag) => in_array($contain, $bag) ? ++$count : $count, 0);
}

$input = array_reduce(
  array_filter(
    array_map(
      fn($line) => explode(' contain ', $line),
      explode("\n", $file)
    ),
    fn($line) => $line[1] !== 'no other bags.'
  ),
  function ($arr, $line) {
    $arr[ sanitise_bag_input($line[0]) ] = array_map('sanitise_bag_input', explode(', ', $line[1]));

    return $arr;
  },
  []
);

$output = array_map(function ($key, $bags) use ($input) {
  // $extra = array_merge($bags, array_reduce($bags, fn($arr, $bag) => array_merge($arr, $bags[$bag])));
  $extra = array_merge($bags, array_reduce($bags, function($arr, $bag) use ($input) {
    if (array_key_exists($bag, $input)) {
      return array_merge($arr, $input[$bag]);
    }

    return $arr;
  }, []));

  return array_unique($extra);
}, array_keys($input), $input);

// var_dump($input, $output);
var_dump(count_bags_contain($output, 'shiny gold'));
