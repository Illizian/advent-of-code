_forked from [Tom Sherman's Deno Boilerplate](https://github.com/tom-sherman/aoc-2023/) because of new rule around downloading the input and a lack of bother for writing my own http code for that hahaha_

🎄🎅 Advent of Code 2023

In Deno!

## Running

Each solution is a module inside `src/` that exports two functions: `solvePart1` and `solvePart2`. They have the type `string => string | Promise<string>`.

To run a solution, pass the day and part numbers to the `solve` script:

```
deno task solve 1 1
deno task solve --day=1 --part=1
```

You'll need a session token from [adventofcode.com](https://adventofcode.com/2022) to check the solutions. This is obtained from the `session` cookie after logging in.
