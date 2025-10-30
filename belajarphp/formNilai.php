<!-- Buat program sederhana dengan satu buah inputan bernama nilai dengan php
 jika nilai lebih dari 90 sampai 100 maka grade A 
 jika nilai lebih dari 80 sampai 89 maka grade B 
 jika nilai lebih dari 70 sampai 79 maka grade C 
 jika nilai lebih dari 60 sampai 69 maka grade D 
 jika nilai lebih dari 0 sampai 59 maka grade E
 
 OUTPUT:
 Nilai anda : 100
 Grade anda : A
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Grade Nilai</title>
</head>

<body>
  <h2>Cek Grade Nilai</h2>

  <form method="post">
    Masukkan Nilai:
    <input type="number" min="0" max="100" name="nilai" required>
    <button type="submit" name="check">Cek</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nilai = $_POST["nilai"];
    $grade = "";

    // Tentukan grade
    if ($nilai >= 90 && $nilai <= 100) {
      $grade = "A";
      $status = "Lulus";
    } elseif ($nilai >= 80 && $nilai <= 89) {
      $grade = "B";
      $status = "Lulus";
    } elseif ($nilai >= 70 && $nilai <= 79) {
      $grade = "C";
      $status = "Lulus";
    } elseif ($nilai >= 60 && $nilai <= 69) {
      $grade = "D";
      $status = "Tidak Lulus";
    } elseif ($nilai >= 0 && $nilai <= 59) {
      $grade = "E";
      $status = "Tidak Lulus";
    } else {
      $nilai = "Nilai Tidak Valid";
      $grade = "Grade Tidak Valid";
      $status = "Status Tidak Valid";
    }

    // echo "<br><br>";
    echo "<br>";

    echo "<h3>OUTPUT</h3>";
    echo "Nilai Anda : $nilai <br>";
    echo "Grade Anda : $grade <br>";
    echo "Status Anda : $status <br>";
  }
  ?>

  <?php
 if (isset($_POST['check'])) {
  $nilai = $_POST['nilai'];
  $grade = "";

  switch ($nilai) {
    case $nilai >= 90 && $nilai <= 100;
    $grade = "A";
    break;
  }
 } 
  
  
  ?>

</body>

</html>