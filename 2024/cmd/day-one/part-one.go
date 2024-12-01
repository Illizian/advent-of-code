package main

import (
	"bufio"
	"fmt"
	"math"
	"os"
	"sort"
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

	sort.Slice(lefts, func(a, b int) bool {
		return lefts[a] < lefts[b]
	})

	sort.Slice(rights, func(a, b int) bool {
		return rights[a] < rights[b]
	})

	sum := 0
	for i := 0; i < len(lefts); i++ {
		sum += int(math.Abs(float64(lefts[i] - rights[i])))
	}

	fmt.Println(sum)
}
