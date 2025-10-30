<?php
session_start();
session_regenerate_id();

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

  $loginBerhasil = false;

  foreach ($users as $user) {
    if ($inputkanEmail == $user['email'] && $inputkanPassword == $user['pass']) {
      $_SESSION['EMAIL'] = $user['email'];
      $loginBerhasil = true;
      break;
    }
  }

  if ($loginBerhasil) {
    header("location:dasboard.php");
    die;
  } else {
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

    <?php
    if (isset($_SESSION['EMAIL'])) {
      echo "<a herf='dasboard.php'>Home</a>";
    } else {
      echo "<button type='submit' name='login'>Login</button>";
    }
    ?>
    <!-- <button type="submit" name="login">Login</button> -->
  </form>
</body>

</html>