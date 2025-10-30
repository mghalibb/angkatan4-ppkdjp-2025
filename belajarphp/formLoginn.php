<?php
session_start();

if (isset($_POST['login'])) {
  $inputkanEmail = htmlspecialchars($_POST['email']);
  $inputkanPassword = htmlspecialchars($_POST['password']);

  $users = [
    [
      "email" => "doni1@gmail.com",
      "pass" => "12345"
    ],
    [
      "email" => "doni2@gmail.com",
      "pass" => "12345"
    ],
    [
      "email" => "doni3@gmail.com",
      "pass" => "12345"
    ]
  ];

  // 1. Buat variabel penanda untuk status login
  $loginBerhasil = false;

  // 2. Lakukan perulangan untuk memeriksa setiap user
  foreach ($users as $user) {
    if ($inputkanEmail == $user['email'] && $inputkanPassword == $user['pass']) {
      // Jika cocok, set session, ubah penanda, dan hentikan loop
      $_SESSION['EMAIL'] = $user['email'];
      $loginBerhasil = true;
      break; // Hentikan loop karena user sudah ditemukan
    }
  }

  // 3. Periksa status login setelah loop selesai
  if ($loginBerhasil) {
    // Jika penanda true, arahkan ke dashboard
    header("location:dasboard.php");
    die;
  } else {
    // Jika penanda false, berarti tidak ada user yang cocok
    header("location:formLogin.php?error=invalid");
    die;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Grade Nilai</title>
</head>

<body>
  <?php
  if (isset($_GET['error']) && $_GET['error'] == "invalid") {
    echo "<script>alert('Email atau Password Salah');</script>";
  }
  ?>
  <form action="" method="post">
    <label for="">Email</label><br>
    <input type="email" name="email" required><br>

    <label for="">Password</label><br>
    <input type="password" name="password" required><br>

    <button type="submit" name="login">Login</button>
  </form>
</body>

</html>