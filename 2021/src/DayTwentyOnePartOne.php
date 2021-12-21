<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illuminate\Support\Collection;

class DayTwentyOnePartOne
{
    protected function __construct(
        // We track $player position as -1, so 0 is 1
        protected int $player_1,
        protected int $player_2,
        protected int $player_1_score = 0,
        protected int $player_2_score = 0,
        protected int $win = 1000,
        // We track $dice side as -1, so 0 is 1
        protected int $dice = 0,
        protected int $rolls = 0,
        protected int $max = 100000,
    ) {}
    
    public static function make(array $input): static
    {
        $player_1_start = intval(str_replace('Player 1 starting position: ', '', $input[0]));
        $player_2_start = intval(str_replace('Player 2 starting position: ', '', $input[1]));

        return new static(
            $player_1_start - 1,
            $player_2_start - 1,
        );
    }

    public function process(): int
    {
        return $this->run() * $this->rolls;
    }

    protected function run(): int
    {
        // For each player
        // 1. Generate the next 3 dice rolls
        // 2. Increment player position by dice roll score
        // 3. Add player position to score
        // 4. Check for winner

        // # Player 1
        $points = $this->roll();
        $this->player_1 = ($this->player_1 + $points) % 10;
        $this->player_1_score += ($this->player_1 + 1);

        if ($this->player_1_score >= $this->win) {
            return $this->player_2_score;
        }

        // # Player 2
        $points = $this->roll();
        $this->player_2 = ($this->player_2 + $points) % 10;
        $this->player_2_score += ($this->player_2 + 1);

        if ($this->player_2_score >= $this->win) {
            return $this->player_1_score;
        }

        if ($this->rolls >= $this->max) {
            throw new Exception("Rolls ($this->rolls) has hit it's limit ($this->max)");
        }

        // Niether player has won, let's go deeper :D
        return $this->run();
    }

    protected function roll(): int
    {
        // Generate the next 3 rolls as an array
        $rolls = range($this->dice + 1, $this->dice + 3);

        // Increment deterministic $dice to next position
        $this->dice = ($this->dice + 3) % 100;

        // Increment the dice rolls
        $this->rolls += 3;
        
        // Add up the dice rolls and return the result
        return array_reduce($rolls, fn(int $result, int $score) => $result + $score, 0);
    }
}