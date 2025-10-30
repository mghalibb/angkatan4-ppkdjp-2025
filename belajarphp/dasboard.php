<?php
session_start();
session_regenerate_id();

//Jika session 'EMAIL" mati, maka kembali kelogin
if (empty($_SESSION['EMAIL'])) {
  header('location:formLogin.php');
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
  <h1>Selamat Datang <?php echo $_SESSION['EMAIL'] ?></h1>
  <a href="formLogout.php">Log-out</a>
</body>
</html>