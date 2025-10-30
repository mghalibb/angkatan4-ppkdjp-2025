// Run node NaN.js

document.writeln(`<p>${parseInt("1.9")}</p>`);
document.writeln(`<p>${parseFloat("1.1")}</p>`);
document.writeln(`<p>${Number("1.1")}</p>`);

const a = 1;
const b = 1;
const total = a.toString() + b.toString();
document.writeln(`<p>${total}</p>`);

document.writeln(`<p>${parseInt("1salah")}</p>`);
document.writeln(`<p>${parseFloat("1.1eko")}</p>`);

document.writeln(`<p>${Number("1salah")}</p>`);
document.writeln(`<p>${Number("1.1eko")}</p>`);
document.writeln(`<p>${Number("salah")}</p>`);

const first = Number('salah');
const totalNumber = first + 100;
document.writeln(`<p>${totalNumber}</p>`);

document.writeln(`<p>${isNaN(first)}</p>`);