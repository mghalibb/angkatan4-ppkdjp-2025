let arrayKosong = [];

let arrayNama = ['Eko', 'kurniawan', 'Khanedy', 12, true];

// document.writeln(arrayNama);

// Menambah Data

const names = [];
names.push('Eko');
names.push('Kurniawan', 'Khanedy');
names.push("Budi", "Joko", "Anwar");

console.table(names);

console.info(names[2]);
console.info(names[4]);

names[3] = "Wamwam";
console.table(names);

delete names[5];
console.table(names);

names.push('Eko Anwar');
console.table(names);

names[5] = "Data Dirubah";
names.push(1,2,3,4,5);
names.push("Eko", "Bambang", "Nugraha")

console.table(names);
// console.info(names length);

// document.writeln(names);