<?php

namespace Illizian\AdventOfCode\Helpers;

use Illuminate\Support\Collection;

class Board
{
    
    public function __construct(
        Collection $boards,
        public ?string $last
    ) {
        $this->tiles = $boards->map(fn($row) => collect(preg_split("/\s+/", trim($row)))->mapInto(Tile::class));
    }

    public function isClear(): bool
    {
        // Calculate the sum of rows/cols, and determine if cleared
        $rows = $this->tiles->map(fn(Collection $row) => $row->where('cleared')->count());
        $cols = $this->tiles->reduce(fn($sum, $row) => array_map(
            fn($col, $tile) => $tile->cleared ? $col + 1 : $col,
            $sum ?? array_fill(0, $row->count(), 0),
            $row->toArray()
        ));

        return (
            $rows->some(5) ||
            collect($cols)->some(5)
        );
    }

    public function match(string $value): self
    {
        $this->last = $value;
        $this->tiles = $this->tiles->map->map(fn(Tile $tile) => $tile->toggle($value));

        return $this;
    }

    public function score()/* : int */
    {
        return $this->tiles->flatten(2)->where('cleared', false)->sum(fn(Tile $tile) => intval($tile->value));
    }
}