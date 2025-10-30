<?php
// array: tipe data atau struktur data yang bisa menyimpan nilai lebih dari satu

// 
$keranjang = "Semangka, Salak, Melon"; // hanya 1 data
$keranjang_array = ["Semangka", "Salak", "Melom"]; // data nya lebih dari 0, 1, 2 
// $keranjang_array = array("", "");

// $keranjang_array[] = "Pisang";
// $keranjang_array[] = "Nanas";
array_push($keranjang_array, "Pisang", "Nanas");

echo "Keranjang : " . $keranjang . "<br>";
print_r($keranjang_array);
echo "<br>";
echo "Keranjang : " . $keranjang_array[1] . "<br>";

// index-array
echo "<h1>Array  Assosiative</h1>";
// Element acces nya di akses mengunakan string atau integer yang ditetapkan
// $peserta = array();

$peserta = [
  // "nama" => "Reza Ibrahim",
  // "umur" => 30,
  // "kelas" => "Web Programing",
  
  [
    "nama" => "Reza Ibrahim",
    "umur" => 30,
    "kelas" => "Web Programing",
  ],
  
  [
    "nama" => "Bambang Ibrahim",
    "umur" => 32,
    "kelas" => "Mobile Programing",
  ],
];

print_r($peserta);
echo "<br>";

foreach ($peserta as $key => $siswa) {
  echo "<br>";
  echo $siswa['nama'] . " Ini Adalah Index Ke : " . $key;
}

// foreach ($peserta as $key => $siswa) {
//   echo $key . " : " . $siswa . "<br>";
// }

// foreach ($peserta as $key => $siswa) {
//   echo $key . " : " . $siswa . "<br>";
// }

// echo "Nama Peserta : " . $peserta['nama'] . "<br>";
// echo "Umur : " . $peserta['umur'] . "<br>";
// echo "Kelas : " . $peserta['kelas'] . "<br>";


?>