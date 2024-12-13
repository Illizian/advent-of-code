package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	type work struct {
		stone, count int
	}
	const workers = 4
	const ticks = 75
	const multiplier = 2024

	// Open input file
	file, err := os.Open("./input/day-eleven.txt")
	if err != nil {
		fmt.Printf("Error opening file: %v\n", err)
		return
	}
	defer file.Close()

	// Read file contents
	var lines []string
	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		lines = append(lines, scanner.Text())
	}
	if err := scanner.Err(); err != nil {
		fmt.Printf("Error reading file: %v\n", err)
		return
	}

	// Initialize input map
	input := make(map[int]int, 1e6)
	for _, char := range strings.Fields(lines[0]) {
		num := parseInt(char)
		input[num]++
	}

	// Whip those workers
	for tick := 0; tick < ticks; tick++ {
		workCh := make(chan work)
		resultCh := make(chan map[int]int, workers)

		// Start workers
		for i := 0; i < workers; i++ {
			go func() {
				stones := make(map[int]int)
				for w := range workCh {
					stone, count := w.stone, w.count
					if stone == 0 {
						stones[1] += count
					} else if digits := digits(stone); digits%2 == 0 {
						left, right := split(stone, digits)
						stones[left] += count
						stones[right] += count
					} else {
						stones[stone*2024] += count
					}
				}
				resultCh <- stones
			}()
		}

		// Distribute work
		for stone, count := range input {
			if count > 0 {
				workCh <- work{stone, count}
			}
		}

		close(workCh)

		// Aggregate results
		newInput := make(map[int]int)
		for i := 0; i < workers; i++ {
			for k, v := range <-resultCh {
				newInput[k] += v
			}
		}
		input = newInput
	}

	total := 0
	for _, count := range input {
		total += count
	}

	fmt.Println(total)
}

// Helper functions
func stones(m map[int]int) []int {
	keys := make([]int, 0, len(m))
	for key, count := range m {
		for i := 0; i < count; i++ {
			keys = append(keys, key)
		}
	}
	return keys
}

func digits(n int) int {
	digits := 0
	for n > 0 {
		digits++
		n /= 10
	}
	return digits
}

func split(n, digits int) (int, int) {
	divisor := 1
	for i := 0; i < digits/2; i++ {
		divisor *= 10
	}
	return n / divisor, n % divisor
}

// lib utils
func parseInt(s string) int {
	num, err := strconv.Atoi(s)
	if err != nil {
		fmt.Printf("Error converting %s to integer: %v\n", s, err)
		return 0
	}
	return num
}
