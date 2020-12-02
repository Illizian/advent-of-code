<?php

$file = file_get_contents(__DIR__ . '/input.txt');

$numbers = array_map('intval', explode("\n", $file));

foreach ($numbers as $index => $a) {
    foreach ($numbers as $b) {
        if(($a + $b) === 2020) {
			echo "Your answer is: " . ($a * $b) . "\n";
            break 2;
        }
    }
}
