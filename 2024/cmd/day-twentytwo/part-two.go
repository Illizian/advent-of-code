package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
)

func main() {
	secrets := []int{}

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

	// Generate some Cartesian goodness
	fmt.Println("Generating Cartesian Goodness...")
	cartesians := make(map[[4]int]int)
	for x1 := -9; x1 <= 9; x1++ {
		for x2 := -9; x2 <= 9; x2++ {
			for x3 := -9; x3 <= 9; x3++ {
				for x4 := -9; x4 <= 9; x4++ {
					cartesians[[4]int{x1, x2, x3, x4}] = 0
				}
			}
		}
	}

	type Price struct {
		Secret, Price, Change int
		Sequence              [4]int
	}

	// Evolve secrets, infer price, and calculate change
	fmt.Println("Evolving...")
	iterations := 2000
	buyers := make(map[int][]Price)
	for index, secret := range secrets {
		buyers[index] = append(buyers[index], Price{
			Secret:   secret,
			Price:    secret % 10,
			Change:   0,
			Sequence: [4]int{},
		})

		for step := 1; step < iterations+1; step++ {
			evolution := evolve(buyers[index][step-1].Secret)
			price := evolution % 10
			change := price - buyers[index][step-1].Price

			var sequence [4]int
			front := MaxInt(0, step-3)
			end := MinInt(step+3, len(buyers[index]))

			for s := range end - front {
				if front+s > len(buyers[index])-1 {
					break
				}

				sequence[s] = buyers[index][front+s].Change
			}

			sequence[3] = change

			buyers[index] = append(buyers[index], Price{
				Secret:   evolution,
				Price:    price,
				Change:   change,
				Sequence: sequence,
			})
		}
	}

	fmt.Println("Calculating sequence value...")

	for cartesian := range cartesians {
		for _, buyer := range buyers {
			for i, price := range buyer {
				if i < 4 {
					// No need to check the first few prices, as they don't have a complete sequence
					continue
				}

				if price.Sequence == cartesian {
					cartesians[cartesian] += price.Price
					break
				}
			}
		}
	}

	fmt.Println("Finding highest value sequence...")
	bestSequence, bestScore := [4]int{}, 0
	for cartesian, score := range cartesians {
		if score > bestScore {
			bestSequence = cartesian
			bestScore = score
		}
	}

	fmt.Println(bestSequence, bestScore)
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

func MinInt(a, b int) int {
	if a < b {
		return a
	}
	return b
}
func MaxInt(a, b int) int {
	if a > b {
		return a
	}
	return b
}
