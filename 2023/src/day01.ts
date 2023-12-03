export function solvePart1(input: string) {
  const lines = input.split("\n");

  return lines
    .map((row) => row.split(""))
    .map((chars) =>
      chars
        .map((char) => Number.parseInt(char))
        .filter((num) => !Number.isNaN(num))
    )
    .map((nums) => Number.parseInt(`${nums[0]}${nums[nums.length - 1]}`))
    .reduce((sum, num) => sum + num);
}
