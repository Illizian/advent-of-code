package main

import (
	"bufio"
	"fmt"
	"os"
	"regexp"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("./input/day-three.txt")
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

	input := strings.Join(lines, "")

	re := regexp.MustCompile(`mul\((\d*),(\d*)\)`)

	sum := 0
	matches := re.FindAllStringSubmatch(input, -1)
	fmt.Printf("%s\n", matches)
	fmt.Printf("%d\n", len(matches))

	for _, match := range matches {
		// @TODO: Jesus wept, I've gotta abstract this to a helper or start using an assert pattern for errors
		left, err := strconv.Atoi(match[1])
		if err != nil {
			panic(err)
		}

		right, err := strconv.Atoi(match[2])
		if err != nil {
			panic(err)
		}

		sum = sum + left*right
	}

	fmt.Println(sum)
}
