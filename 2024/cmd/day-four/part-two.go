package main

import (
	"advent-of-code-2024/pkg/file"
	"fmt"
)

func main() {
	lines, err := file.Input("./input/day-four.txt")
	if err != nil {
		panic(err)
	}

	grid := make([][]rune, len(lines))
	for i, line := range lines {
		grid[i] = []rune(line)
	}

	sum := 0
	for row := 1; row < len(grid)-1; row++ {
		for col := 1; col < len(grid[row])-1; col++ {
			// 1.2  M.S  M.M  S.M  S.S
			// ...  .A.  .A.  .A.  .A.
			// 3.4  M.S  S.S  S.M  M.M
			if grid[row][col] == 'A' {
				if grid[row-1][col-1] == 'M' && grid[row-1][col+1] == 'S' && grid[row+1][col-1] == 'M' && grid[row+1][col+1] == 'S' {
					sum++
				}
				if grid[row-1][col-1] == 'M' && grid[row-1][col+1] == 'M' && grid[row+1][col-1] == 'S' && grid[row+1][col+1] == 'S' {
					sum++
				}
				if grid[row-1][col-1] == 'S' && grid[row-1][col+1] == 'M' && grid[row+1][col-1] == 'S' && grid[row+1][col+1] == 'M' {
					sum++
				}
				if grid[row-1][col-1] == 'S' && grid[row-1][col+1] == 'S' && grid[row+1][col-1] == 'M' && grid[row+1][col+1] == 'M' {
					sum++
				}
			}
		}
	}

	fmt.Println(sum)
}
