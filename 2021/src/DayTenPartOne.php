<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Illuminate\Support\Collection;

class DayTenPartOne
{
    // List of open close tokens
    public static array $tokens = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
        '<' => '>',
    ];

    // List of token value
    protected static array $values = [
        ')' => 3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
    ];

    public static function process(array $input): int
    {
        return collect($input)
            ->map(fn(string $line) => static::validLine($line))
            ->filter(fn(array|string $valid) => is_string($valid))
            ->sum(fn(string $token) => static::$values[$token]);
    }
    
    /**
     * Takes a $line, and computes validity returning either:
     * - An empty array (valid)
     * - An array of remaining open tokens (incomplete)
     * - A string representing a syntax error
     * 
     * @param string $line
     * 
     * @return array|array|string
     */
    public static function validLine(string $line): array|string
    {
        return collect(str_split($line))
            ->reduce(function(null|array|string $bag, string $token) {
                if (is_string($bag)) return $bag;

                if (in_array($token, array_keys(static::$tokens))) {
                    // $token is an open bracket
                    // push to the $bag
                    array_push($bag, $token);
                }

                if (in_array($token, static::$tokens)) {
                    // $token is a close bracket
                    // Check if valid
                    if (! static::tokenIsValidClose($token, $bag)) {
                        // $token is not a valid close token
                        return $token;
                    }
                    
                    // $token is valid, so remove the open from $bag
                    array_pop($bag);
                }
                
                return $bag;
            }, []);
    }

    public static function tokenIsValidClose(string $token, array $bag): bool
    {
        return static::$tokens[$bag[array_key_last($bag)]] === $token;
    }
}