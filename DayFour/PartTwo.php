<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$passports = array_map(function($string) {
  $clean = str_replace("\n", " ", $string);
  $groups = explode(" ", $clean);

  return array_reduce($groups, function($arr, $group) {
    [ $key, $val ] = explode(":", $group);

    $arr[$key] = $val;
    return $arr;
  }, []);
}, explode("\n\n", $file));

$valid = array_filter($passports, function($p) {
  // Check all required fields are available
  if (
    ! array_key_exists('byr', $p) ||
    ! array_key_exists('iyr', $p) ||
    ! array_key_exists('eyr', $p) ||

    ! array_key_exists('hgt', $p) ||

    ! array_key_exists('hcl', $p) ||
    ! array_key_exists('ecl', $p) ||
    ! array_key_exists('pid', $p)
  ) {
    return false;
  }

  // byr (Birth Year) - four digits
  // iyr (Issue Year) - four digits
  // eyr (Expiration Year) - four digits
  if (strlen($p['byr']) !== 4 || strlen($p['iyr']) !== 4 || strlen($p['eyr']) !== 4) {
    return false;
  }

  // byr (Birth Year) - at least 1920 and at most 2002.
  // iyr (Issue Year) - at least 2010 and at most 2020.
  // eyr (Expiration Year) - at least 2020 and at most 2030.
  if (
    ((int) $p['byr'] < 1920 || (int) $p['byr'] > 2002) ||
    ((int) $p['iyr'] < 2010 || (int) $p['iyr'] > 2020) ||
    ((int) $p['eyr'] < 2020 || (int) $p['eyr'] > 2030)
  ) {
    return false;
  }

  // hgt (Height) - a number followed by either cm or in:
  if (preg_match('/^\d+(cm|in)/', $p['hgt']) === 0) {
    return false;
  }

  // If hgt is cm, the number must be at least 150 and at most 193.
  // If hgt is in, the number must be at least 59 and at most 76.
  $hgt = (int) substr($p['hgt'], 0, -2);
  $unit = substr($p['hgt'], -2);

  if ($unit === 'cm') {
    if ((int) $hgt < 150 || (int) $hgt > 193) {
      return false;
    }
  } else if ($unit === 'in') {
    if ((int) $hgt < 59 || (int) $hgt > 76) {
      return false;
    }
  } else {
    return false;
  }

  // hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
  if (preg_match('/^#[a-f0-9]{6}$/', $p['hcl']) === 0) {
    return false;
  }

  // ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
  if (in_array($p['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']) === false) {
    return false;
  }

  // pid (Passport ID) - a nine-digit number, including leading zeroes.
  if (strlen($p['pid']) !== 9) {
    return false;
  }

  return true;
});

var_dump(count($valid));
