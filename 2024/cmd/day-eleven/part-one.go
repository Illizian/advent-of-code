package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
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

	// parse input
	var input []int
	for _, char := range strings.Split(lines[0], " ") {
		num := parseInt(string(char))
		input = append(input, num)
	}

	fmt.Println(input)
	ticks := 25

	for tick := 0; tick < ticks; tick++ {
		for index := 0; index < len(input); index++ {
			num := input[index]
			char := strconv.Itoa(num)
			digits := len(char)

			if num == 0 {
				input[index] = 1
				continue
			}

			if digits%2 == 0 {
				left := parseInt(char[:digits/2])
				right := parseInt(char[digits/2:])

				input = splice(input, index, 1, []int{left, right})
				index = index + 1
				continue
			}

			input[index] = input[index] * 2024
		}
	}

	fmt.Println(len(input))
}

func splice[T any](slice []T, index, deleteCount int, values []T) []T {
	output := make([]T, 0, len(slice)+len(values)-deleteCount)

	output = append(output, slice[:index]...)
	output = append(output, values...)
	output = append(output, slice[index+deleteCount:]...)

	return output
}

func parseInt(s string) int {
	num, err := strconv.Atoi(s)
	if err != nil {
		panic(err)
	}

	return num
}
