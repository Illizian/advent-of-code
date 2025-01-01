package main

import (
	"advent-of-code-2024/pkg/file"
	"advent-of-code-2024/pkg/math"
	"advent-of-code-2024/pkg/util"
	"fmt"
	"strings"
)

func main() {
	input, err := file.Input("./input/day-two.txt")
	if err != nil {
		panic(err)
	}

	// Let's do some type conversions
	var reports [][]int
	for _, line := range input {
		var report []int
		for _, char := range strings.Split(line, " ") {
			report = append(report, util.ParseInt(char))
		}

		reports = append(reports, report)
	}

	// Ok, let's check zee levels...
	sum := 0
	for _, report := range reports {
		if isSafe(report) {
			sum++
		}
	}

	fmt.Println(sum)
}

func isSafe(report []int) bool {
	if report[1] == report[0] {
		return false
	}

	dir := (report[1] - report[0]) / math.Abs(report[1]-report[0])

	for step := 1; step < len(report); step++ {
		prev := report[step-1]
		curr := report[step]

		// The levels are either all increasing or all decreasing.
		if curr > prev && dir == -1 {
			return false
		}

		if prev > curr && dir == 1 {
			return false
		}

		// The difference between any two adjacent levels is at least 1 and at most 3.
		if prev == curr || prev-curr > 3 || prev-curr < -3 {
			return false
		}
	}

	return true
}
