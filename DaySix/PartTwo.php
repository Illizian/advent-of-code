<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$output = array_reduce(
  array_map(
    fn($group) => count(call_user_func_array('array_intersect', $group)),
    array_map(
      fn($group) => array_map(
        fn($member) => str_split($member),
        explode("\n", $group)
      ),
      explode("\n\n", $file)
    )
  ),
  fn($total, $count) => $total + $count,
  0
);




// $output = array_reduce(
//   array_map(
//     // fn($group) => count(array_unique($group)),
//     function ($group) {
//       var_dump($group);
//       return count(array_unique($group));
//     },
//     array_map(
//       fn($group) => array_filter(
//         str_split($group),
//         fn($char) => $char !== "\n"
//       ),
//       explode("\n\n", $file)
//     )
//   ),
//   fn($total, $group) => $total + $group,
//   0
// );

var_dump($output);
