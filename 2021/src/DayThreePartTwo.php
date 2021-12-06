<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illuminate\Support\Collection;

Collection::macro('transpose', function () {
    $items = array_map(function (...$items) {
        return $items;
    }, ...$this->values());

    return new static($items);
});

class DayThreePartTwo
{
    public static function process(array $input): int
    {
        return (
            bindec((new self)->run(collect($input))) *
            bindec((new self)->run(collect($input), true))
        );
    }
    
    protected function run(Collection $input, bool $scrubber = false, int $column = 0): string
    {
        if ($input->count() === 1) return $input->first();
        if ($column > strlen($input->first())) throw new Exception("Error: Could not resolve", $input);
        
        $mode = $this->getColumnMode($input, $column);

        return $this->run(
            $input->filter(fn(string $row) => intval($row[$column]) === ($scrubber ? $mode ^= 1 : $mode)),
            $scrubber,
            $column + 1
        );
    }

    protected function getColumnMode(Collection $input, int $column): int
    {
        return $input
            ->map(fn($row) => str_split($row))
            ->transpose()
            ->map(function($bits) {
                $mode = collect($bits)->mode();

                // If there are more than 1 mode, we should return 1
                return count($mode) > 1
                    ? 1
                    : $mode[0];
            })

            ->get($column);
    }
}