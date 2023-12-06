export function solvePart1(input: string) {
  const [header, ...data] = input.split("\n\n");
  const seeds = header
    ?.replace("seeds: ", "")
    .split(" ")
    .map((n) => Number.parseInt(n));

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

export function solvePart2(input: string) {}
