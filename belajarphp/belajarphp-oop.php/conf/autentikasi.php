<?php
session_start();

include "../conf/config.php";

if (empty($_POST['email']) || empty($_POST['password'])) {
    header("location:../index.php?error=2");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, username, password, role_id FROM users WHERE email = ? AND delete_at IS NULL";
$stmt = mysqli_prepare($connection, $sql);

if (!$stmt) {
    header("location:../index.php?error=3");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role_id'] = $user['role_id'];

    header("location:../inc/index.php");
    exit();

} else {
    header("location:../index.php?error=1");
    exit();
}
?>