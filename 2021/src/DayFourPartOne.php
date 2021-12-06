<?php

declare(strict_types = 1);

namespace Illizian\AdventOfCode;

use Exception;
use Illizian\AdventOfCode\Helpers\Board;
use Illuminate\Support\Collection;

class DayFourPartOne
{ 
    public static function process(array $input): int
    {
        return (new self)->bingo(
            explode(',', $input[0]),
            array_slice($input, 2)
        );
    }

    protected function bingo(array $numbers, array $input): int
    {
        $boards = Collection::make($input)
            ->filter()
            ->chunk(5)
            ->mapInto(Board::class);
        
        $winner = $this->run($boards, $numbers);
        
        return $winner->score() * intval($winner->last);
    }

    protected function run(Collection $boards, array $numbers): Board
    {
        if ($boards->some->isClear()) {
            return $boards->filter(fn(Board $board) => $board->isClear())->first();
        }

        if (count($numbers) === 0) {
            throw new Exception('No winning board found');
        }

        $target = array_shift($numbers);

        return $this->run($boards->map->match($target), $numbers);
    }
}