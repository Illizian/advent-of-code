<?php

use Illizian\AdventOfCode\Helpers\Matrix;

dataset(
    'grids',
    [
        [[1,2,3,4,5,6]],
        [[1,2,3], [4,5,6]],
        [[1,2,3], [4,5,6], [7,8,9]],
    ]
);

dataset(
    'grids-three-wide',
    [
        [[1,2,3], [4,5,6]],
        [[4,5,6], [1,2,3]],
        [[1,2,3], [4,5,6], [7,8,9]],
        [[1,2,3], [4,5,6], [7,8,9], [10,11,12]],
    ]
);

it('can create a Matrix from a grid array', function (array ...$grid) {
    expect(Matrix::make($grid))
        ->toBeInstanceOf(Matrix::class);
})->with('grids');

it('can ascertain the correct width of a grid from a grid array', function (array ...$grid) {
    expect(Matrix::make($grid))->width()->toBe(3);
})->with('grids-three-wide');

it('can create a get an item from a Matrix', function (array ...$grid) {
    expect(Matrix::make($grid))
        ->get(1, 0)
        ->toEqual(2);

    expect(Matrix::make($grid))
        ->get(2, 0)
        ->toEqual(3);
})->with('grids');

it('can serialize a Matrix back to the grid array it came from', function (array ...$grid) {
    expect(Matrix::make($grid))
        ->__toArray()
        ->toEqual($grid);
})->with('grids');

it('can get the neighbors of a cell in a grid', function (array ...$grid) {
    $matrix = Matrix::make([
        [1,2,3],
        [4,5,6],
        [7,8,9]
    ]);

    expect($matrix)
        ->getNeighbors(1, 1)
        ->toArray()
        ->toEqual([
            'up' => 2,
            'right' => 6,
            'down' => 8,
            'left' => 4,
        ]);

    expect($matrix)
        ->getNeighbors(0, 0)
        ->toArray()
        ->toEqual([
            'up' => null,
            'right' => 2,
            'down' => 4,
            'left' => null,
        ]);

    expect($matrix)
        ->getNeighbors(2, 2)
        ->toArray()
        ->toEqual([
            'up' => 6,
            'right' => null,
            'down' => null,
            'left' => 8,
        ]);
})->with('grids');