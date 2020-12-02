# Advent of Code 2020

- Benchmarking with Hyperfine

```
hyperfine \
  --warmup 3 \
  --min-runs 100 \
  --export-markdown benchmarks.md \
  '<command>' '<another-command>'
```

- Benchmarking with the included `Makefile`

Check the configuration:

```bash
# IMAGES should be a space seperate list of docker images you wish to test with
IMAGES := php:8.0.0-cli php:7.4.3-cli php:7.1-cli php:7-cli php:5.4-cli php:5.3-cli
# COMMAND is the language parser, along with any flags required
COMMAND := php
# Configuration for Hyperfine:
WARMUP := 3
MIN_RUNS := 100
```

Then you can launch the run with:

```sh
$ make
```

_This will start Docker containers for each of the IMAGES, and run COMMAND <FileName> for the every file matching the glob `Day*/Part*.*`_

Alternatively, you can use the individual targets within:

- **pull**: (Docker) Pull the reference IMAGES
- **launch**: Start each of the referenced IMAGES
- \_test: Run COMMAND <FileName> against each of the IMAGES previously launched
- \_benchmark: Run COMMAND <FileName> against each of the IMAGES using [hyperfine](https://github.com/sharkdp/hyperfine)
- **clean**: Shutdown and Remove the referenced IMAGES

### Current Benchmarks

The included `Makefile` will export a benchmark as `benchmarks_$$(date +"%Y_%m_%d_%I_%M_%p").md`, the following table are my current results

| Command | Mean [ms] | Min [ms] | Max [ms] | Relative |
|:---|---:|---:|---:|---:|
| `docker exec advent-of-code_php800cli php ./DayTwo/PartTwo.php` | 149.7 ± 13.3 | 128.0 | 193.9 | 1.09 ± 0.15 |
| `docker exec advent-of-code_php743cli php ./DayTwo/PartTwo.php` | 148.2 ± 13.7 | 128.4 | 189.8 | 1.07 ± 0.16 |
| `docker exec advent-of-code_php71cli php ./DayTwo/PartTwo.php` | 149.1 ± 16.7 | 127.0 | 234.6 | 1.08 ± 0.17 |
| `docker exec advent-of-code_php7cli php ./DayTwo/PartTwo.php` | 149.0 ± 17.7 | 121.8 | 200.7 | 1.08 ± 0.18 |
| `docker exec advent-of-code_php54cli php ./DayTwo/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayTwo/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayTwo/PartOne.php` | 167.2 ± 24.3 | 126.8 | 222.8 | 1.21 ± 0.22 |
| `docker exec advent-of-code_php743cli php ./DayTwo/PartOne.php` | 155.7 ± 22.0 | 123.6 | 213.8 | 1.13 ± 0.20 |
| `docker exec advent-of-code_php71cli php ./DayTwo/PartOne.php` | 152.2 ± 20.4 | 125.4 | 226.1 | 1.10 ± 0.19 |
| `docker exec advent-of-code_php7cli php ./DayTwo/PartOne.php` | 147.1 ± 14.6 | 120.6 | 186.9 | 1.07 ± 0.16 |
| `docker exec advent-of-code_php54cli php ./DayTwo/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayTwo/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayOne/PartTwo.php` | 185.1 ± 19.0 | 156.6 | 279.5 | 1.34 ± 0.20 |
| `docker exec advent-of-code_php743cli php ./DayOne/PartTwo.php` | 182.0 ± 13.7 | 156.7 | 237.8 | 1.32 ± 0.18 |
| `docker exec advent-of-code_php71cli php ./DayOne/PartTwo.php` | 210.6 ± 15.0 | 188.4 | 269.3 | 1.53 ± 0.20 |
| `docker exec advent-of-code_php7cli php ./DayOne/PartTwo.php` | 183.7 ± 15.3 | 161.8 | 231.5 | 1.33 ± 0.19 |
| `docker exec advent-of-code_php54cli php ./DayOne/PartTwo.php` | 317.3 ± 18.2 | 290.7 | 408.9 | 2.30 ± 0.29 |
| `docker exec advent-of-code_php53cli php ./DayOne/PartTwo.php` | 329.2 ± 26.4 | 296.2 | 440.1 | 2.39 ± 0.33 |
| `docker exec advent-of-code_php800cli php ./DayOne/PartOne.php` | 173.4 ± 26.6 | 124.1 | 270.8 | 1.26 ± 0.24 |
| `docker exec advent-of-code_php743cli php ./DayOne/PartOne.php` | 148.0 ± 18.5 | 124.1 | 213.5 | 1.07 ± 0.18 |
| `docker exec advent-of-code_php71cli php ./DayOne/PartOne.php` | 149.8 ± 16.1 | 128.1 | 220.1 | 1.09 ± 0.17 |
| `docker exec advent-of-code_php7cli php ./DayOne/PartOne.php` | 145.9 ± 15.3 | 118.8 | 194.7 | 1.06 ± 0.16 |
| `docker exec advent-of-code_php54cli php ./DayOne/PartOne.php` | 143.1 ± 13.4 | 123.7 | 180.4 | 1.04 ± 0.15 |
| `docker exec advent-of-code_php53cli php ./DayOne/PartOne.php` | 139.6 ± 17.7 | 114.6 | 196.9 | 1.01 ± 0.17 |