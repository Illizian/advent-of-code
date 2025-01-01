package main

import (
	"advent-of-code-2024/pkg/file"
	"fmt"
)

var directions = [][2]int{
	{-1, -1}, {-1, 0}, {-1, 1},
	{0, -1}, {0, 1},
	{1, -1}, {1, 0}, {1, 1},
}

func main() {
	lines, err := file.Input("./input/day-four.txt")
	if err != nil {
		panic(err)
	}

	grid := make([][]rune, len(lines))
	for i, line := range lines {
		grid[i] = []rune(line)
	}

	needle := []rune("XMAS")
	sum := 0

	for row := 0; row < len(grid); row++ {
		for col := 0; col < len(grid[row]); col++ {
			if grid[row][col] == needle[0] {
				for _, dir := range directions {
					if search(grid, needle, row, col, 0, dir) {
						sum++
					}
				}
			}
		}
	}

	fmt.Println(sum)
}

func search(grid [][]rune, needle []rune, row, col, depth int, dir [2]int) bool {
	// Boundary
	if row < 0 || col < 0 || row >= len(grid) || col >= len(grid[0]) {
		return false
	}

	if grid[row][col] != needle[depth] {
		return false
	}

	// If the last character matches, we've found the word
	if depth == len(needle)-1 {
		return true
	}

	newRow, newCol := row+dir[0], col+dir[1]
	if search(grid, needle, newRow, newCol, depth+1, dir) {
		return true
	}

	return false
}
