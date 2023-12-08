// Get some numbers from the command line, or use the default 1, 4, 3, 295.
let numbers: Uint32Array;
if (Deno.args.length > 0) {
  numbers = new Uint32Array(Deno.args.map((a) => parseInt(a)));
} else {
  numbers = new Uint32Array([1, 4, 3, 295]);
}

const adapter = await navigator.gpu.requestAdapter();
const device = await adapter?.requestDevice();

if (!device) {
  console.error("no suitable adapter found");
  Deno.exit(0);
}

export {}