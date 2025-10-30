<?php
include 'functions.php';
checkLogin();
include("../conf/config.php");

if (isset($_GET['page']) && $_GET['page'] == 'tambah-user' && isset($_POST['simpan'])) {
    $posted_id = $_POST['id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    if (empty($posted_id)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($connection, "INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed_password, $role_id);
        mysqli_stmt_execute($stmt);
        header("location:index.php?page=user&tambah=berhasil");
    } else {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, password=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $hashed_password, $role_id, $posted_id);
        } else {
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssii", $username, $email, $role_id, $posted_id);
        }
        mysqli_stmt_execute($stmt);
        header("location:index.php?page=user&ubah=berhasil");
    }
    exit();
}

if (isset($_GET['page']) && $_GET['page'] == 'payment' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_json = $_POST['cart_data'] ?? '[]';
    $cart_items = json_decode($cart_json, true);

    if (empty($cart_items)) {
        header("location:index.php?page=point-of-sale&error=empty_cart");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <link href="../assets/img/ppkdjp.png" type="image/png" rel="icon" />
  <title>Point of Sales 2025</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon" />
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet" />

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header Start ======= -->
  <?php include 'header.php' ?>
  <!-- ======= Header End ======= -->

  <!-- ======= Sidebar Start ======= -->
  <?php include 'sidebar.php' ?>
  <!-- ======= Sidebar End ======= -->

  <main id="main" class="main">
    <?php
    if (isset($_GET['page'])) {
          $page = $_GET['page'];
          $page = basename($page); 
          $file_path = '../pages/' . $page . '.php';
    if (file_exists($file_path)) {
        include $file_path;
    } else {
        include '../pages/error-404.php'; 
    }
    } else {
    include '../pages/dashboard.php';
    }
    ?>
  </main>
  <!-- End #main -->

  <!-- ======= Footer Start ======= -->
  <?php include 'footer.php' ?>
  <!-- ======= Footer End ======= -->
  
</body>

</html>