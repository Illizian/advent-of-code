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
	file, err := os.Open("./input/day-eleven.txt")
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

	// map[stone] = count
	input := make(map[int]int)
	for _, char := range strings.Split(lines[0], " ") {
		num := parseInt(string(char))
		input[num] = get(input, num, 0) + 1
	}

	ticks := 75

	for tick := 0; tick < ticks; tick++ {
		start := time.Now()

		stones := stones(input)

		for _, stone := range stones {
			char := strconv.Itoa(stone)
			digits := len(char)

			if stone == 0 {
				input[stone] = get(input, stone, 1) - 1
				input[1] = get(input, 1, 0) + 1
				continue
			}

			if digits%2 == 0 {
				left := parseInt(char[:digits/2])
				right := parseInt(char[digits/2:])

				input[stone] = get(input, stone, 1) - 1
				input[left] = get(input, left, 0) + 1
				input[right] = get(input, right, 0) + 1
				continue
			}

			input[stone] = get(input, stone, 1) - 1
			input[stone*2024] = get(input, stone*2024, 0) + 1
		}

		duration := time.Now().Sub(start)
		fmt.Printf("Completed Tick #%d, in %.2fsecs\n", tick, duration.Seconds())
	}

	total := 0
	for _, count := range input {
		total = total + count
	}

	fmt.Println(total)
}

func stones(m map[int]int) []int {
	keys := make([]int, 0, len(m))
	for key, count := range m {
		if count == 0 {
			continue
		}

		for range count {
			keys = append(keys, key)
		}
	}

	return keys
}

func splice[T any](slice []T, index, deleteCount int, values []T) []T {
	output := make([]T, 0, len(slice)+len(values)-deleteCount)

	output = append(output, slice[:index]...)
	output = append(output, values...)
	output = append(output, slice[index+deleteCount:]...)

	return output
}

func get[K comparable, V any](m map[K]V, key K, defaultValue V) V {
	if value, exists := m[key]; exists {
		return value
	}
	return defaultValue
}

func parseInt(s string) int {
	num, err := strconv.Atoi(s)
	if err != nil {
		panic(err)
	}

	return num

}
