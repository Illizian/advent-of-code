<?php

$input = file_get_contents(__DIR__ . '/input.txt');

$numbers = array_map('intval', explode("\n", $input));

foreach ($numbers as $a) {
    foreach ($numbers as $b) {
        foreach ($numbers as $c) {
            if($a +  $b +  $c === 2020) {
				echo "Your answer is: " . ($a * $b * $c) . "\n";
                break 3;
            }
        }
    }
}
