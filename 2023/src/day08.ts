export function solvePart1(input: string) {
  const [header, data] = input.split("\n\n");
  const directions = header?.replace("\n\n", "").split("");
  
  if(!directions || !directions.length || !data || !data.length) {
    throw new Error("Parsing failed");
  }

  const routes = data?.split("\n")
    .map((route) => route.replace("(", "").replace(")", "").split(" = ") as [string, string])
    .map(([key, destination]) => ({key, destination: destination.split(", ") as [string, string]}))
    .reduce((acc, route) => {
      acc[route.key] = route.destination;

      return acc;
    }, {} as Record<string, [string, string]>)

  let steps = 0;
  let current = "AAA";

  while (current !== "ZZZ") {
    let direction = +(directions[steps % directions.length] === "R");

    steps = steps + 1;
    // @ts-ignore
    current = routes[current][direction];
  }

  return steps;
}

export function solvePart2(input: string) {}