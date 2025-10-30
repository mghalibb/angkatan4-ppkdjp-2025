<?php
session_start();
include '../../conf/config.php';
header('Content-Type: application/json');

$code = isset($_GET['code']) ? strtoupper(trim($_GET['code'])) : '';

if (empty($code)) {
  echo json_encode(['success' => false, 'message' => 'Code Cannot Be Empty']);
  exit();
}

$stmt = mysqli_prepare(
  $connection,
  "SELECT `type`, `value` FROM discounts 
     WHERE `code` = ? AND `is_active` = 1 AND (`expires_at` IS NULL OR `expires_at` > NOW())"
);
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($discount = mysqli_fetch_assoc($result)) {
  echo json_encode([
    'success' => true,
    'type' => $discount['type'],
    'value' => (float) $discount['value']
  ]);
} else {
  echo json_encode(['success' => false, 'message' => 'Discount Code Is Invalid Or Expired.']);
}
exit();
?>