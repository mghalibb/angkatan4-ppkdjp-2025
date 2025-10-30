<?php
session_start();
include '../../conf/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'mark_paid' && isset($_GET['id'])) {    
    $order_id = (int)$_GET['id'];    
    $stmt = mysqli_prepare($connection, "UPDATE orders SET order_status = 1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    
    header("location:../../inc/index.php?page=order-list&update=success");
    exit();

} else {
    header("location:../../inc/index.php?page=order-list");
    exit();
}
?>