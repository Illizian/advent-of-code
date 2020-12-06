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
| `docker exec advent-of-code_php800cli php ./DaySix/PartTwo.php` | 150.2 ± 16.7 | 123.2 | 192.1 | 1.13 ± 0.19 |
| `docker exec advent-of-code_php743cli php ./DaySix/PartTwo.php` | 147.6 ± 13.4 | 122.3 | 187.7 | 1.11 ± 0.17 |
| `docker exec advent-of-code_php71cli php ./DaySix/PartTwo.php` | 145.9 ± 15.6 | 122.1 | 189.0 | 1.10 ± 0.18 |
| `docker exec advent-of-code_php7cli php ./DaySix/PartTwo.php` | 149.8 ± 19.5 | 124.0 | 212.3 | 1.13 ± 0.20 |
| `docker exec advent-of-code_php54cli php ./DaySix/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DaySix/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DaySix/PartOne.php` | 146.3 ± 14.0 | 122.3 | 186.0 | 1.10 ± 0.17 |
| `docker exec advent-of-code_php743cli php ./DaySix/PartOne.php` | 146.0 ± 14.1 | 122.3 | 185.7 | 1.10 ± 0.17 |
| `docker exec advent-of-code_php71cli php ./DaySix/PartOne.php` | 142.5 ± 14.7 | 121.0 | 184.2 | 1.07 ± 0.17 |
| `docker exec advent-of-code_php7cli php ./DaySix/PartOne.php` | 145.3 ± 17.1 | 119.6 | 186.1 | 1.09 ± 0.19 |
| `docker exec advent-of-code_php54cli php ./DaySix/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DaySix/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayFive/PartTwo.php` | 204.8 ± 11.3 | 173.0 | 240.6 | 1.05 ± 0.10 |
| `docker exec advent-of-code_php743cli php ./DayFive/PartTwo.php` | 246.5 ± 83.2 | 189.1 | 625.6 | 1.26 ± 0.44 |
| `docker exec advent-of-code_php71cli php ./DayFive/PartTwo.php` | 234.5 ± 67.9 | 180.5 | 551.7 | 1.20 ± 0.36 |
| `docker exec advent-of-code_php7cli php ./DayFive/PartTwo.php` | 206.7 ± 11.6 | 178.2 | 240.4 | 1.06 ± 0.10 |
| `docker exec advent-of-code_php54cli php ./DayFive/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayFive/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayFive/PartOne.php` | 208.4 ± 11.7 | 176.6 | 242.0 | 1.07 ± 0.10 |
| `docker exec advent-of-code_php743cli php ./DayFive/PartOne.php` | 246.2 ± 63.6 | 187.7 | 434.2 | 1.26 ± 0.34 |
| `docker exec advent-of-code_php71cli php ./DayFive/PartOne.php` | 221.0 ± 55.7 | 173.3 | 557.2 | 1.13 ± 0.30 |
| `docker exec advent-of-code_php7cli php ./DayFive/PartOne.php` | 208.4 ± 11.2 | 183.7 | 233.9 | 1.07 ± 0.10 |
| `docker exec advent-of-code_php54cli php ./DayFive/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayFive/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayFour/PartTwo.php` | 142.5 ± 13.6 | 119.6 | 183.1 | 1.04 ± 0.14 |
| `docker exec advent-of-code_php743cli php ./DayFour/PartTwo.php` | 143.2 ± 13.4 | 120.1 | 189.3 | 1.05 ± 0.14 |
| `docker exec advent-of-code_php71cli php ./DayFour/PartTwo.php` | 145.5 ± 17.8 | 118.0 | 209.5 | 1.06 ± 0.17 |
| `docker exec advent-of-code_php7cli php ./DayFour/PartTwo.php` | 141.2 ± 12.4 | 119.4 | 177.5 | 1.03 ± 0.14 |
| `docker exec advent-of-code_php54cli php ./DayFour/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayFour/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayFour/PartOne.php` | 150.0 ± 15.3 | 122.5 | 196.4 | 1.10 ± 0.16 |
| `docker exec advent-of-code_php743cli php ./DayFour/PartOne.php` | 152.2 ± 15.6 | 128.7 | 201.4 | 1.11 ± 0.16 |
| `docker exec advent-of-code_php71cli php ./DayFour/PartOne.php` | 143.9 ± 13.3 | 123.1 | 191.7 | 1.05 ± 0.14 |
| `docker exec advent-of-code_php7cli php ./DayFour/PartOne.php` | 143.2 ± 14.1 | 124.3 | 183.8 | 1.05 ± 0.15 |
| `docker exec advent-of-code_php54cli php ./DayFour/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayFour/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayThree/PartTwo.php` | 167.0 ± 26.8 | 129.6 | 258.3 | 1.20 ± 0.22 |
| `docker exec advent-of-code_php743cli php ./DayThree/PartTwo.php` | 148.8 ± 14.4 | 124.3 | 200.0 | 1.07 ± 0.15 |
| `docker exec advent-of-code_php71cli php ./DayThree/PartTwo.php` | 146.7 ± 14.3 | 127.8 | 203.3 | 1.05 ± 0.14 |
| `docker exec advent-of-code_php7cli php ./DayThree/PartTwo.php` | 152.3 ± 16.6 | 129.1 | 213.0 | 1.09 ± 0.16 |
| `docker exec advent-of-code_php54cli php ./DayThree/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayThree/PartTwo.php` | - | - | - | - |
| `docker exec advent-of-code_php800cli php ./DayThree/PartOne.php` | 153.2 ± 13.9 | 131.3 | 205.1 | 1.10 ± 0.15 |
| `docker exec advent-of-code_php743cli php ./DayThree/PartOne.php` | 149.9 ± 13.8 | 127.9 | 209.9 | 1.07 ± 0.14 |
| `docker exec advent-of-code_php71cli php ./DayThree/PartOne.php` | 149.2 ± 13.7 | 126.6 | 193.7 | 1.07 ± 0.14 |
| `docker exec advent-of-code_php7cli php ./DayThree/PartOne.php` | 149.0 ± 12.0 | 128.1 | 186.1 | 1.07 ± 0.14 |
| `docker exec advent-of-code_php54cli php ./DayThree/PartOne.php` | - | - | - | - |
| `docker exec advent-of-code_php53cli php ./DayThree/PartOne.php` | - | - | - | - |
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

## TODO

- Get Hyperpixel running inside the container, and pickup the output. (So we're timing the argument and not the docker exec time)
- Add a new level of directory nesting for language/argument specific so it becomes /php/Day*/Part*.*