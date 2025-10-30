<?php
session_start();
include '../../conf/config.php';

if (isset($_GET['action'])) {

    // --- Action Untuk Menghapus User DARI user.php Ke restore-user.php ---
    if ($_GET['action'] == 'soft_delete' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = mysqli_prepare($connection, "UPDATE users SET delete_at=now() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=user&hapus=berhasil");
        exit();
    }

    // --- Action Untuk Mengembalikan User Dari restore-user.php Ke user.php---
    if ($_GET['action'] == 'restore' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = mysqli_prepare($connection, "UPDATE users SET delete_at=NULL WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=user&restore=berhasil");
        exit();
    }

    // --- Action Untuk Menghapus Permanen User Dari restore-user.php---
    if ($_GET['action'] == 'permanent_delete' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = mysqli_prepare($connection, "DELETE FROM users WHERE id = ? AND delete_at IS NOT NULL");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=restore-user&hapus-permanen=berhasil");
        exit();
    }
}

// Cek apakah ada data form yang disubmit (dari tambah-user.php)
if (isset($_POST['simpan'])) {
    $posted_id = $_POST['id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    if (empty($posted_id)) {
        // Proses Tambah Data
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($connection, "INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed_password, $role_id);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=user&tambah=berhasil");
    } else {
        // Proses Ubah Data
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, password=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $hashed_password, $role_id, $posted_id);
        } else {
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssii", $username, $email, $role_id, $posted_id);
        }
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=user&ubah=berhasil");
    }
    exit();
}
?>