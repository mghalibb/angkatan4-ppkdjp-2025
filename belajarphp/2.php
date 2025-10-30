<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar PHP</title>
</head>

<body>
  <?php
  $nama = "Bambang";
  $umur = 25;
  $berat_badan = 65.5;

  // define()
  define("nama", "Bambang Pamungkas");

  // const
  const posisi = "Striker";
  const posisi = "kiper";

    ?>
  <h1>Selamat Datang <?php echo $nama ?></h1>
  <?php
  echo "<p>$umur</p> <br> <p>$berat_badan</p>";
  echo "Nama Pemain : " . nama . "<br>";
  echo "Posisi : " . posisi . "<br>";
    ?>
</body>

</html>