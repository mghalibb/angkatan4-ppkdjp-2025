<?php
session_start();
include '../../conf/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
  $id = (int) $_GET['id'];

  $stmt_delete = mysqli_prepare($connection, "DELETE FROM discounts WHERE id = ?");
  mysqli_stmt_bind_param($stmt_delete, "i", $id);
  mysqli_stmt_execute($stmt_delete);

  header("location:../../inc/index.php?page=discounts&hapus=berhasil");
  exit();
}

if (isset($_POST['simpan'])) {
  $posted_id = !empty($_POST['id']) ? (int) $_POST['id'] : 0;

  $code = strtoupper(trim($_POST['code']));
  $type = $_POST['type'];
  $value = (float) $_POST['value'];
  $is_active = (int) $_POST['is_active'];

  $expires_at = !empty($_POST['expires_at']) ? date('Y-m-d H:i:s', strtotime($_POST['expires_at'])) : NULL;

  if (empty($posted_id)) {
    $stmt = mysqli_prepare($connection, "INSERT INTO discounts (code, type, value, is_active, expires_at) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssdis", $code, $type, $value, $is_active, $expires_at);
    mysqli_stmt_execute($stmt);
    header("location:../../inc/index.php?page=discounts&tambah=berhasil");
  } else {
    $stmt = mysqli_prepare($connection, "UPDATE discounts SET code=?, type=?, value=?, is_active=?, expires_at=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssdisi", $code, $type, $value, $is_active, $expires_at, $posted_id);
    mysqli_stmt_execute($stmt);
    header("location:../../inc/index.php?page=discounts&ubah=berhasil");
  }
  exit();
}
?>