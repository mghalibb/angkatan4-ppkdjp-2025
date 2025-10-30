<?php
$_hostname = "localhost";
$_username = "root";
$_password = "";
$_database = "db_pointofsale2025";

$connection = mysqli_connect($_hostname, $_username, $_password, $_database);

if (!$connection) {
  die('Connection Failed' . mysqli_connect_error());
}

// try {
//     $dsn = "mysql:host=$_hostname;dbname=$_database;charset=utf8mb4";

//     $options = [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//         PDO::ATTR_EMULATE_PREPARES => false,
//     ];

//     $pdo = new PDO($dsn, $username, $password, $options);

//     echo "Koneksi Ke Database ($db_name) Berhasil!";

// } catch (PDOException $e) {
//     die("Koneksi Ke Database Gagal: " . $e->getMessage());
// }
?>