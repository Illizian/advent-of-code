package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("./input/day-nine.txt")
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

	disk := strings.Split(lines[0], "")

	// Expand the disk map
	id := 0
	isFile := true
	for i := 0; i < len(disk); {
		count, err := strconv.Atoi(disk[i])
		if err != nil {
			panic(err)
		}

		var char string
		if isFile {
			char = fmt.Sprintf("%d", id)
			id++
		} else {
			char = "."
		}
		disk = splice(disk, i, 1, pack(count, char))

		i = i + count
		isFile = !isFile
	}

	// Compress
	r := len(disk) - 1
	for l := 0; l != r; {
		left := disk[l]
		right := disk[r]

		if left != "." {
			// Left is not free space
			l++
			continue
		}

		if left == "." && right == "." {
			// Left is free, but right is not a file
			r--
			continue
		}

		if left == "." && right != "." {
			// left is free, and right is a file
			// I think we can swap?
			disk[l] = right
			disk[r] = "."
			l++
			r--
		}
	}

	// Generate checksum
	checksum := 0
	for i, val := range disk {
		if val == "." {
			break
		}

		id, err := strconv.Atoi(val)
		if err != nil {
			panic(err)
		}

		checksum = checksum + i*id
	}

	fmt.Println("==== Result ====")
	fmt.Println(checksum)
}

func pack(size int, char string) []string {
	slice := make([]string, size)
	for i := range slice {
		slice[i] = char
	}

	return slice
}

func splice(slice []string, index, deleteCount int, values []string) []string {
	output := make([]string, 0, len(slice)+len(values)-deleteCount)

	output = append(output, slice[:index]...)
	output = append(output, values...)
	output = append(output, slice[index+deleteCount:]...)

	return output
}
