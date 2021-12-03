<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$valid = array_filter(explode("\n", $file), function($string) {
	[ $rules, $password ] = explode(': ', $string);
	[ $positions, $char ] = explode(' ', $rules);
	[ $left, $right ] = explode('-', $positions);

	$a = $password[$left - 1];
	$b = $password[$right - 1];

	return (
		$a !== $b &&
		( $a === $char || $b === $char)
	);
});

echo "Your answer is: " . count($valid) . "\n";