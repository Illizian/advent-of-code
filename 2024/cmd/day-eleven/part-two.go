package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
	"time"
)

func main() {
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
	input := make(map[int]int)
	for _, char := range strings.Fields(lines[0]) {
		num := parseInt(char)
		input[num]++
	}

	// Process ticks
	for tick := 0; tick < ticks; tick++ {
		start := time.Now()

		stones := stones(input)

		for _, stone := range stones {
			currentCount := input[stone]
			if currentCount == 0 {
				continue
			}
			input[stone]--

			if stone == 0 {
				input[1]++
			} else if digits := digits(stone); digits%2 == 0 {
				left, right := split(stone, digits)
				input[left]++
				input[right]++
			} else {
				input[stone*multiplier]++
			}
		}

		duration := time.Since(start)
		fmt.Printf("Completed Tick #%d in %.2f secs\n", tick, duration.Seconds())
	}

	// Calculate total
	total := 0
	for _, count := range input {
		total += count
	}
	fmt.Println(total)
}

// Helper functions
func stones(m map[int]int) []int {
	keys := make([]int, 0)
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

func parseInt(s string) int {
	num, err := strconv.Atoi(s)
	if err != nil {
		fmt.Printf("Error converting %s to integer: %v\n", s, err)
		return 0
	}
	return num
}
