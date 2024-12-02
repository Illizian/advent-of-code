package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("./input/day-two.txt")
	if err != nil {
		panic(err)
	}

	defer file.Close()

	var lines []string
	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		lines = append(lines, scanner.Text())
	}

	if err := scanner.Err(); err != nil {
		fmt.Println("Error reading file:", err)
	}

	safe := 0

safe:
	for _, line := range lines {
		nums := strings.Split(line, " ")
		dir := 0

		for i := 1; i < len(nums); i++ {
			prev, err := strconv.Atoi(nums[i-1])
			if err != nil {
				panic(err)
			}

			curr, err := strconv.Atoi(nums[i])
			if err != nil {
				panic(err)
			}

			// Any two adjacent levels differ by at least one and at most three.
			if prev == curr || prev-curr > 3 || prev-curr < -3 {
				continue safe
			}

			// The levels are either all increasing or all decreasing.
			if prev > curr && dir == 1 {
				continue safe
			}

			if curr > prev && dir == -1 {
				continue safe
			}

			// Register direction
			if dir == 0 {
				if prev > curr {
					dir = -1
				} else {
					dir = 1
				}
			}
		}

		safe = safe + 1
	}

	fmt.Println(safe)
}
