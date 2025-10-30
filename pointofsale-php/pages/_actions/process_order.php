<?php
session_start();
include '../../conf/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cart_data = json_decode($_POST['cart_data'], true);
  $total_amount = (float) $_POST['total_amount'];
  $payment_method = $_POST['payment_method'];

  $discount_code = $_POST['discount_code'] ?? NULL;
  $discount_amount = (float) ($_POST['discount_amount'] ?? 0);

  if (empty($cart_data) || $total_amount <= 0) {
    header("location:../../inc/index.php?page=pos&error=empty_cart");
    exit();
  }

  // 1. Buat Order Utama Di Tabel 'orders'
  $order_code = 'ORD-' . date('YmdHis') . '-' . strtoupper(substr(uniqid(), -4));

  $sql_order = "INSERT INTO orders (order_code, total_amount, order_status, payment_method, discount_code, discount_amount) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt_order = mysqli_prepare($connection, $sql_order);
  // $status = 1; // 0 = Pending, 1 = Finished, 2 = Canceled
  $status = 0; // 0 = Pending, 1 = Finished, 2 = Canceled
  mysqli_stmt_bind_param($stmt_order, "sdissd", $order_code, $total_amount, $status, $payment_method, $discount_code, $discount_amount);
  mysqli_stmt_execute($stmt_order);

  // Ambil ID Dari Order Yang Baru Saja Dibuat
  $order_id = mysqli_insert_id($connection);

  // 2. Masukkan setiap item di keranjang ke tabel 'order_details'
  $sql_details = "INSERT INTO order_details (order_id, product_id, qty, price_at_sale, subtotal) VALUES (?, ?, ?, ?, ?)";
  $stmt_details = mysqli_prepare($connection, $sql_details);

  foreach ($cart_data as $item) {
    // $product_id = $item['id']; // Before
    $product_id = (int) $item['id']; // After
    // $qty = $item['qty']; // Before
    $qty = (int) $item['qty']; // After
    // $price = $item['price']; // Before
    $price = (float) $item['price']; // After
    $subtotal = $qty * $price;
    mysqli_stmt_bind_param($stmt_details, "iiidd", $order_id, $product_id, $qty, $price, $subtotal);
    mysqli_stmt_execute($stmt_details);
  }

  header("location:../../inc/index.php?page=point-of-sale&success=order_placed");
  exit();
}
?>