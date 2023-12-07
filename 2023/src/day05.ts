export function solvePart1(input: string) {
  const [header, ...data] = input.split("\n\n");
  const seeds = header
    ?.replace("seeds: ", "")
    .split(" ")
    .map((n) => Number.parseInt(n));

  return solveSeeds(seeds ?? [], data);
}

export function solvePart2(input: string) {
  const [header, ...data] = input.split("\n\n");
  const seeds = header
    ?.replace("seeds: ", "")
    .split(" ")
    .map((n) => Number.parseInt(n));

  const pairs = Array.from(
    { length: (seeds?.length ?? 0) / 2 },
    (_, i) => seeds?.slice(i * 2, i * 2 + 2),
  ) as [number, number][];

  const locations = pairs.map(function (pair: [number, number]) {
    const [start, count] = pair;
    // console.log({ pair, start, count });
    let min = Infinity;

    for (let i = start ?? 0; i < start + (count ?? 0); i++) {
      // console.log({ min, i });
      min = Math.min(solveSeeds([i], data), min);
    }

    return min;
  });

  return Math.min(...locations);
}

function solveSeeds(seeds: number[], data: string[]) {
  const maps = data.map(function (category) {
    const [key, ...data] = category.replace(" map:", "").split("\n");

    const map = data.map(function (line) {
      const [destination, source, length] = line.split(" ");

      return {
        destination: Number.parseInt(destination ?? ""),
        source: Number.parseInt(source ?? ""),
        length: Number.parseInt(length ?? ""),
      };
    });

    return { key, map };
  });

  const locations = (seeds ?? []).map(function (seed) {
    return maps.reduce(function (index, dictionary) {
      const match = dictionary.map.find(function ({ source, length }) {
        return index >= source && index <= source + length;
      });

      if (match) {
        return match.destination + (index - match.source);
      }

      return index;
    }, seed);
  });

  return Math.min(...locations);
}
