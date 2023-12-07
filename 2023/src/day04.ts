export function solvePart1(input: string) {
  return (
    input
      .split("\n")
      // Remove the "Card \d: " part, and split into "winning numbers" and your "hand strings"
      .map((row) => (row.split(": ")[1] ?? "").split(" | "))
      // Parse winning and hand strings, into number[]
      .map(([winning, hand]) => ({
        winning: parseCards(winning),
        hand: parseCards(hand),
      }))
      // Count the winning numbers in hand
      .map(
        ({ winning, hand }) =>
          hand.filter((handCard) => winning.includes(handCard)).length,
      )
      // Use exponent to calculate value of hand
      .map((count) => (count !== 0 ? Math.pow(2, count - 1) : 0))
      // Total it up
      .reduce((sum, count) => sum + count, 0)
  );
}

export function solvePart2(input: string) {}

// Parses a line " 1 10 20  3 40" => [1, 10, 20, 3, 40]
// note: consideration of extra left pad numbers
function parseCards(winning: string | undefined): number[] {
  return (winning ?? "")
    .split(" ")
    .map((char) => Number.parseInt(char.trim()))
    .filter(Boolean);
}
