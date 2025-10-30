<?php
// > lebih dari
// < kurang dari
// == membandingkan
// === membandingkan menggunakan tipe data
// !=
// !

$nama = "Reza";
if ($nama == "Reza") {
  echo "Ya";
} else {
  echo "Bukan";
}

echo "<br>";

$namas = "Reza";
if ($namas != "Reza") {
  echo "Ya";
} else {
  echo "Bukan";
}

echo "<br>";

$nilai = 50;
if ($nilai >= 80) {
  $grade = "A";
} elseif ($nilai >= 70) {
  $grade = "B";
} elseif ($nilai >= 60) {
  $grade = "C";
} else {
  $grade = "D";
}

if ($nilai >= 70) {
  $status = "Selamat Anda Lulus";
} else {
  $status = "Anda Tidak Lulus";
}

echo "Nama : " . $nama . "<br>";
echo "Nilai : " . $nilai . "<br>";
echo "Grade : " . $grade . "<br>";
echo "Status : " . $status . "<br>";


echo "<br><br>";

$warna = "merah";
if ($warna == "kuning") {
  echo "warna favorit kuning";
} elseif ($warna == "merah") {
  echo "warna favorit merah";
} elseif ($warna == "hijau") {
  echo "warna favorit hijau";
} else {
  echo "terserah";
}

echo "<br>";

switch ($warna) {
  case 'merah':
    echo "Warna favorit merah";
    break;
  case 'kuning':
    echo "Warna favorit kuning";
    break;
  case 'hijau':
    echo "Warna favorit hijau";
    break;
  default:
    echo "Terserah warna apa saja";
    break;
}

?>