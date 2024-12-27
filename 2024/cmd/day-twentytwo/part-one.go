package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
)

func main() {
	secrets := []int{}
	iterations := 2000
	sum := 0

	file, err := os.Open("./input/day-twentytwo.txt")
	if err != nil {
		panic(err)
	}

	defer file.Close()

	// Parse Input
	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		text := scanner.Text()

		secrets = append(secrets, parseInt(text))
	}

	if err := scanner.Err(); err != nil {
		fmt.Println("Error reading file:", err)
	}

	for _, secret := range secrets {
		s := secret
		for x := 0; x < iterations; x++ {
			secret = evolve(secret)
		}

		fmt.Println(s, secret)
		sum += secret
	}

	fmt.Println(sum)
}

func evolve(secret int) int {
	// Step 1: Multiply by 64, mix, and prune
	secret = prune(mix(secret*64, secret))

	// Step 2: Divide by 32, mix, and prune
	secret = prune(mix(secret/32, secret))

	// Step 3: Multiply by 2048, mix, and prune
	secret = prune(mix(secret*2048, secret))

	return secret
}

func mix(val, secret int) int {
	return val ^ secret
}

func prune(secret int) int {
	return secret % 16777216
}

func parseInt(s string) int {
	num, err := strconv.Atoi(s)
	if err != nil {
		panic(err)
	}

	return num
}
