import { assertEquals } from "std/testing/asserts.ts";

import { solvePart1, solvePart2 } from "./day08.ts";

const sampleInput1 = `RL

AAA = (BBB, CCC)
BBB = (DDD, EEE)
CCC = (ZZZ, GGG)
DDD = (DDD, DDD)
EEE = (EEE, EEE)
GGG = (GGG, GGG)
ZZZ = (ZZZ, ZZZ)`;

const sampleInput2 = ``;

Deno.test("part 1", () => {
  assertEquals(solvePart1(sampleInput1), 2);
});

// Deno.test("part 2", () => {
//   assertEquals(solvePart2(sampleInput2), 281);
// });
