<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayEightPartTwo
{
    public static function process(array $input): int
    {
        /**
         * digit x = x segments @ [abcdefg] = 1111111 (127) **
         * digit 1 = 2 segments @ [  c  f ] = 0010010 ( 18) **
         * digit 7 = 3 segments @ [a c  f ] = 1010010 ( 82) **
         * digit 4 = 4 segments @ [ bcd f ] = 0111010 ( 58) **
         * digit 8 = 7 segments @ [abcdefg] = 1111111 (127) **
         *
         * digit 0 = 6 segments @ [abc efg] = 1110111 (119)
         * digit 2 = 5 segments @ [a cde g] = 1011101 ( 93)
         * digit 3 = 5 segments @ [a cd fg] = 1011011 ( 91)
         * digit 5 = 5 segments @ [ab d fg] = 1101011 (107)
         * digit 6 = 6 segments @ [ab defg] = 1101111 (111)
         * digit 9 = 6 segments @ [abcd fg] = 1111011 (123)
         */
        
        return 1;
    }
}