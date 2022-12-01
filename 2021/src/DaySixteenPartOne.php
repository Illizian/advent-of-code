<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DaySixteenPartOne
{
    public static function process(array $input): int
    {
        dump(self::hex($input[0][0]));
        dump(self::hex($input[0][1]));
        
        return 1;
    }
    
    protected static function tokenize(string $packet): array
    {
        return [
            'version' => substr($packet, 0, 3),
            'type' => substr($packet, 3, 3),
            'body' => substr($packet, 6),
        ];
    }

    protected static function hex(string $binary): string
    {
        dump($binary);
        return str_pad(
            base_convert($binary, 16, 2),
            4,
            "0",
            STR_PAD_LEFT
        );
    }

}