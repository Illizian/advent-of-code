<?php

namespace Illizian\AdventOfCode\Helpers;

class Tile
{
    public bool $cleared = false;

    public function __construct(
        public string $value,
    ) {}

    public function toggle(string $value): self
    {
        if (! $this->cleared && $this->value === $value) {
            $this->cleared = true;
        }

        return $this;
    }
}