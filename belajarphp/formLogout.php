<?php
session_start();
session_destroy();
$_SESSION = [];
header('location:formLogin.php');
die;
  ?>