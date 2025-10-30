<?php
session_start();
include '../../conf/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = (int) $_GET['id'];

    // 1. Hitung Ada Berapa Produk Yang Menggunakan Kategori Ini
    $check_stmt = mysqli_prepare($connection, "SELECT COUNT(*) as total FROM products WHERE category_id = ?");
    mysqli_stmt_bind_param($check_stmt, "i", $id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    $row = mysqli_fetch_assoc($result);
    $product_count = $row['total'];

    // 2. Jika Jumlah Produk Lebih Dari 0, Gagalkan Penghapusan
    if ($product_count > 0) {
        header("location:../../inc/index.php?page=category&error=has_products&count=" . $product_count);
        exit();
    }

    // 3. Jika Tidak Ada Produk Terkait (Jumlah Produk = 0), Baru Hapus Kategori
    $delete_stmt = mysqli_prepare($connection, "DELETE FROM categories WHERE id = ?");
    mysqli_stmt_bind_param($delete_stmt, "i", $id);
    mysqli_stmt_execute($delete_stmt);

    header("location:../../inc/index.php?page=category&hapus=berhasil");
    exit();
}

if (isset($_POST['simpan'])) {
    $posted_id = !empty($_POST['id']) ? (int) $_POST['id'] : 0;
    $category_name = $_POST['category_name'];

    if (empty($category_name)) {
        header("location:../../inc/index.php?page=tambah-category&error=kosong");
        exit();
    }

    if (empty($posted_id)) {
        $stmt = mysqli_prepare($connection, "INSERT INTO categories (category_name) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $category_name);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=category&tambah=berhasil");
    } else {
        $stmt = mysqli_prepare($connection, "UPDATE categories SET category_name = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $category_name, $posted_id);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=category&ubah=berhasil");
    }
    exit();
}
?>