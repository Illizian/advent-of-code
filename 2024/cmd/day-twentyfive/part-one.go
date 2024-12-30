package main

import (
	"bufio"
	"fmt"
	"os"
)

func main() {
	input, _ := input("./input/day-twentyfive.txt")

	CHUNK_SIZE := 7
	PATTERN_SIZE := 5
	var locks [][]int
	var keys [][]int

	for index := 0; index < len(input); index = index + CHUNK_SIZE + 1 {
		isLock := input[index] == "#####"

		pattern := make([]int, 0, 5)
		for col := range PATTERN_SIZE {
			height := 0
			for pin := range PATTERN_SIZE {
				mark := string(input[index+pin+1][col])

				if mark == "#" {
					height++
				}
			}

			pattern = append(pattern, height)
		}

		if isLock {
			locks = append(locks, pattern)
		} else {
			keys = append(keys, pattern)
		}
	}

	matches := 0
	for _, l := range locks {
		for _, k := range keys {
			overlaps := 0
			for index, lockHeight := range l {
				if lockHeight+k[index] > 5 {
					overlaps++
				}
			}

			if overlaps == 0 {
				matches++
			}
		}
	}

	fmt.Println(matches)
}

func input(filename string) ([]string, error) {
	file, err := os.Open(filename)
	if err != nil {
		return nil, err
	}

	defer file.Close()

	var output []string

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		output = append(output, scanner.Text())
	}

	if err := scanner.Err(); err != nil {
		return nil, err
	}

	return output, nil
}
