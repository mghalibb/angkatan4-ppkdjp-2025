<?php
// looping = struktur kode yang digunakan untuk menjalankan blok kode selama kondisi tertentu terpenuhi
// for, while, do while, foreach

for($i = 10; $i >= 1; $i --):
  echo $i . ". Saya tidak akan terlambat lagi <br>";
endfor;

echo "<br><br>";

$a = 1;
while ($a <= 10) {
  echo $a . ". Aku Minta Maaf <br>";
  $a++;
}

echo "<br><br>";

$j = 1;
do {
  echo $j . ". Aku Minta Maaf <br>";
  $j++;
} while ($j <= 10);

echo "<br><br>";

for($x = 1; $x <= 10; $x++) {
  if($x == 5) {
    // break;
    continue;
  }
  echo $x . "<br>";
}

// for() {

// }

?>