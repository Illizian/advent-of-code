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

export function solvePart2(input: string) {
  const lines = input.split("\n");

  return lines
    .map((row) => stringResolver(Object.keys(Numbers), row))
    .map((nums) => Number.parseInt(`${nums[0]}${nums[nums.length - 1]}`))
    .reduce((sum, num) => sum + num);
}

const Numbers: Record<string, number> = {
  one: 1,
  two: 2,
  three: 3,
  four: 4,
  five: 5,
  six: 6,
  seven: 7,
  eight: 8,
  nine: 9,
};

function stringResolver(
  numberStrings: string[],
  input: string,
  acc: number[] = [],
  length = 1,
): number[] {
  const compareString = input.slice(0, length);

  if (input.length === 0) {
    // and we're done!
    return acc;
  }

  if (!Number.isNaN(Number.parseInt(compareString))) {
    // We have a number
    return stringResolver(Object.keys(Numbers), input.slice(1), [
      ...acc,
      Number.parseInt(compareString),
    ]);
  }

  if (numberStrings.includes(compareString)) {
    // We have a number word
    return stringResolver(Object.keys(Numbers), input.slice(1), [
      ...(acc as number[]),
      Numbers[compareString] as number,
    ]);
  }

  // Ok, so we don't have either a number, or a number word
  // Let's create a list of possible number words this input could contain
  const possibleNumberStrings = numberStrings.filter(
    (numberString) => numberString.slice(0, length) === compareString,
  );

  if (possibleNumberStrings.length === 0) {
    // The first character of the current word is not the start of a number word, disregard it
    return stringResolver(Object.keys(Numbers), input.slice(1), acc);
  }

  // Ok, we still have a possible number word, let's keep going.
  return stringResolver(possibleNumberStrings, input, acc, length + 1);
}
