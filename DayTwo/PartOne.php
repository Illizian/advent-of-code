<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$valid = array_filter(explode("\n", $file), function($string) {
	[ $rules, $password ] = explode(': ', $string);
	[ $limit, $char ] = explode(' ', $rules);
	[ $min, $max ] = explode('-', $limit);

	$count = substr_count($password, $char);

	return $max >= $count && $count >= (int) $min;
});

echo "Your answer is: " . count($valid) . "\n";