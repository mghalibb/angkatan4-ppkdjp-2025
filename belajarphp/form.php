<?php
if (isset($_POST['kirim'])) {
  $nama = $_POST['nama'];
  echo "Nama Saya Adalah " . $nama;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="proses.php" method="post" enctype="multipart/form-data">
    <label for="">Nama</label>
    <input type="text" name="nama" id="nama" placeholder="Isi Nama Anda">

    <button type="submit" name="kirim">Kirim</button>
  </form>

</body>

</html>