<?php
session_start();
include '../../conf/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = (int) $_GET['id'];

    $stmt_photo = mysqli_prepare($connection, "SELECT photo FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt_photo, "i", $id);
    mysqli_stmt_execute($stmt_photo);
    $result = mysqli_stmt_get_result($stmt_photo);
    $product = mysqli_fetch_assoc($result);

    if ($product && !empty($product['photo'])) {
        $photo_path = '../../assets/uploads/' . $product['photo'];
        if (file_exists($photo_path)) {
            unlink($photo_path);
        }
    }

    $stmt_delete = mysqli_prepare($connection, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $id);
    mysqli_stmt_execute($stmt_delete);

    header("location:../../inc/index.php?page=product&hapus=berhasil");
    exit();
}

if (isset($_POST['simpan'])) {
    $posted_id = !empty($_POST['id']) ? (int) $_POST['id'] : 0;
    $category_id = $_POST['category_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $product_description = $_POST['product_description'];
    $new_photo_name = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $upload_dir = '../../assets/uploads/';
        if ($posted_id > 0) {
            $q_old_photo = mysqli_prepare($connection, "SELECT photo FROM products WHERE id=?");
            mysqli_stmt_bind_param($q_old_photo, "i", $posted_id);
            mysqli_stmt_execute($q_old_photo);
            $res_old_photo = mysqli_stmt_get_result($q_old_photo);
            $old_product = mysqli_fetch_assoc($res_old_photo);
            if ($old_product && !empty($old_product['photo'])) {
                $old_photo_path = $upload_dir . $old_product['photo'];
                if (file_exists($old_photo_path))
                    unlink($old_photo_path);
            }
        }
        $photo_name = basename($_FILES['photo']['name']);
        $new_photo_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $photo_name);
        move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $new_photo_name);
    }

    if (empty($posted_id)) {
        $stmt = mysqli_prepare($connection, "INSERT INTO products (category_id, product_name, price, product_description, photo) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isdss", $category_id, $product_name, $price, $product_description, $new_photo_name);
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=product&tambah=berhasil");
    } else {
        if (!empty($new_photo_name)) {
            $stmt = mysqli_prepare($connection, "UPDATE products SET category_id=?, product_name=?, price=?, product_description=?, photo=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "isdssi", $category_id, $product_name, $price, $product_description, $new_photo_name, $posted_id);
        } else {
            $stmt = mysqli_prepare($connection, "UPDATE products SET category_id=?, product_name=?, price=?, product_description=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "isdsi", $category_id, $product_name, $price, $product_description, $posted_id);
        }
        mysqli_stmt_execute($stmt);
        header("location:../../inc/index.php?page=product&ubah=berhasil");
    }
    exit();
}
?>