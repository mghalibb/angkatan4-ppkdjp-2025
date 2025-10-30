let angka1 = 20;
let angka2 = 20;

console.log(angka1 + angka2);
console.log(angka1 - angka2);
console.log(angka1 / angka2);
console.log(angka1 * angka2);
console.log(angka1 % angka2);
console.log(angka1 ** angka2);

// Operator Penugasan
let x = 10;
x += 5;
console.log(x);

// operator pembandingan
// >, <, =, ==, ===, !==
let a = 1;
let b = 1;
if (a == b) {
  console.log("Ya");
} else {
  console.log("tidak");
}

console.log(a > b);
console.log(a < b);

// operator logika
// &&, AND, OR, ||, !: tidak / not
let umur = 20;
let punyaSim = true;
if (umur >= 17 && punyaSim) {
  console.log("Boleh Mengemudi");
} else {
  console.log("Tidak Boleh Mengemudi");
}

// array : sebuah tipe data yang bisa memiliki nilainya lebih dari 1
let buah = ['Pisang', 'Salak', 'Semangka'];

console.log("Buah Dikeranjang :", buah);
console.log("Saya Mau Buah :", buah[2]);
buah[1] = "Nanas";
console.log("Buah Baru :", buah);
buah.push('Pepaya');
console.log("Buah", buah);
buah.pop();


const nilaiUjian = 90;
const nilaiAbsensi = 90;

const lulusiUjian = nilaiUjian > 75;
const lulusAbsensi = nilaiAbsensi > 75;

document.writeln(lulusiUjian);
document.writeln(lulusAbsensi);
const lulus = lulusiUjian && lulusAbsensi;
document.writeln(lulus);

document.writeln('\n Eko \n Kurniawan');
