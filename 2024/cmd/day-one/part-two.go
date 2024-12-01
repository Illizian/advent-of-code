package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("./input/day-one.txt")
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

	var lefts []int
	var rights []int

	for _, line := range lines {
		parts := strings.Split(line, "   ")
		left, err := strconv.Atoi(parts[0])
		if err != nil {
			panic(err)
		}

		right, err := strconv.Atoi(parts[1])
		if err != nil {
			panic(err)
		}

		lefts = append(lefts, left)
		rights = append(rights, right)
	}

	sum := 0
	for _, left := range lefts {
		count := 0
		for _, right := range rights {
			if left == right {
				count = count + 1
			}
		}

		sum = sum + (left * count)
	}

	fmt.Println(sum)
}
