<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$passports = array_map(function($string) {
  $clean = str_replace("\n", " ", $string);
  $groups = explode(" ", $clean);

  return array_reduce($groups, function($arr, $group) {
    [ $key, $val ] = explode(":", $group);

    $arr[] = $key;
    return $arr;
  }, []);
}, explode("\n\n", $file));

$valid = array_filter($passports, function($passport) {
  $matches = array_intersect($passport, [
    'byr',
    'iyr',
    'eyr',
    'hgt',
    'hcl',
    'ecl',
    'pid'
  ]);

  return count($matches) >= 7;
});

var_dump(count($valid));
