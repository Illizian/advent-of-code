<?php

namespace Illizian\AdventOfCode\Helpers;

use Illuminate\Support\Collection;

class Matrix
{
    public function __construct(
        protected Collection $cells,
        protected int $width
    ) {}

    public static function make(array $grid): self
    {
        return new static(
            collect($grid)->flatten(),
            count($grid[0])
        );
    }

    public function width(): int
    {
        return $this->width;
    }

    public function cells(): Collection
    {
        return $this->cells;
    }

    public function getCoordinateFromPosition(int $pos): array
    {
        return [
            'x' => $pos % $this->width,
            'y' => floor($pos / $this->width)
        ];
    }

    public function getPositionFromCoordinate(int $x, int $y): int
    {
        return $y * $this->width + $x;
    }

    public function get(int $x, int $y, $default = null)
    {
        return $this->cells->get(
            $this->getPositionFromCoordinate($x, $y),
            $default
        );
    }

    public function getNeighbors(int $x, int $y): Collection
    {
        return collect([
            'up' => $this->get($x, $y - 1),
            'right' => $this->get($x + 1, $y),
            'down' => $this->get($x, $y + 1),
            'left' => $this->get($x - 1, $y),
        ]);
    }

    public function getNeighborsForPosition(int $pos): Collection
    {
        return $this->getNeighbors(...$this->getCoordinateFromPosition($pos));
    }

    public function __toArray(): array
    {
        return $this->cells
            ->chunk($this->width)
            ->map(fn($row) => array_values($row->toArray()))
            ->toArray();
    }
}