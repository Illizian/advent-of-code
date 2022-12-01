<?php

require 'vendor/autoload.php';

use Illuminate\Support\Collection;

$items = collect([
  '199',
  '200',
  '208',
  '210',
  '200',
  '207',
  '240',
  '269',
  '260',
  '263',
]);

$a = '10';

dump(
  $items
    ->map(fn($val) => intval($a))
    ->map(function($val) use ($a) {
      dump($a);
      return intval($val);
    })


    ->sliding(2)
    // ->reduce(function($carry, $item) {
    //   $gt = $item->last() > $item->first();

    //   if ($gt) {
    //     return $carry + 1;
    //   } else {
    //     return $carry;
    //   }
    // }, 0)
    ->reduce(fn(int $sum, Collection $items) => +($items->last() > $items->first()) + $sum, 0)
);

/*

forward 10
up 10

[
  'forward 10',
  'up 10'
]

map($val) -> explode(' ', $val)

[
  [ 'forward', 10 ]
  [ 'up', 10 ]
]

[0,0]


*/

$a = 'test';

switch($a) {
  case 'thing':
  case 'another':
  case 'test':
    dump('test');
    break;

  case 'rich':
    dump('rich');
    break; 
}







