<?php
require_once '../../assets/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include '../../conf/config.php';

if (!isset($_GET['order_id'])) {
    die("Error: Order ID not found.");
}
$order_id = (int) $_GET['order_id'];

$stmt_order = mysqli_prepare($connection, "SELECT * FROM orders WHERE id = ?");
mysqli_stmt_bind_param($stmt_order, "i", $order_id);
mysqli_stmt_execute($stmt_order);
$order_result = mysqli_stmt_get_result($stmt_order);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    die("Error: Order not found.");
}

$stmt_items = mysqli_prepare(
    $connection,
    "SELECT od.*, p.product_name 
     FROM order_details od 
     JOIN products p ON od.product_id = p.id 
     WHERE od.order_id = ?"
);
mysqli_stmt_bind_param($stmt_items, "i", $order_id);
mysqli_stmt_execute($stmt_items);
$items_result = mysqli_stmt_get_result($stmt_items);
$items = mysqli_fetch_all($items_result, MYSQLI_ASSOC);

$subtotal = 0;
foreach ($items as $item) {
    $subtotal += $item['subtotal'];
}
$service_charge = $subtotal * 0.05;
$taxable_amount = $subtotal + $service_charge;
$tax = $taxable_amount * 0.10;
$discount_amount = (float) $order['discount_amount'];

$status_text = '';
$status_color = '#777';

$status = $order['order_status'];
$orderTimestamp = strtotime($order['order_date']);
$currentTimestamp = time();
$timeoutMinutes = 15;
$isExpired = ($currentTimestamp - $orderTimestamp) > ($timeoutMinutes * 60);

if ($status == 1) {
    $status_text = 'Finished';
    $status_color = 'green';
} else if ($status != 1 && $isExpired) {
    $status_text = 'Canceled';
    $status_color = 'red';
} else {
    $status_text = 'Pending';
    $status_color = '#f0ad4e';
}

// =============================================================
// BUAT TEMPLATE HTML UNTUK STRUK/NOTA
// =============================================================
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt ' . $order['order_code'] . '</title>
    <style>
        body { font-family: \'Courier New\', Courier, monospace; margin: 25px; font-size: 14px; }
        .container { width: 100%; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 0; font-size: 12px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border-bottom: 1px dashed #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .no-border td { border: none; padding: 4px 8px; }
        .total td { font-weight: bold; font-size: 16px; border-top: 2px dashed #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Point of Sale 2025</h1>
            <p>PPKD Jakarta Pusat</p>
            <p><strong>OFFICIAL RECEIPT</strong></p>
        </div>

        <p>
            <strong>Order Code:</strong> ' . htmlspecialchars($order['order_code']) . '<br>
            <strong>Order Date:</strong> ' . date('d M Y, H:i', strtotime($order['order_date'])) . '<br>
            <strong>Payment:</strong> ' . htmlspecialchars($order['payment_method']) . '<br>

            <strong>Status:</strong> <span style="color: ' . $status_color . '; font-weight: bold;">
                                        ' . strtoupper($status_text) . '
                                    </span>
        </p>

        <h4>Purchased Items</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>';

foreach ($items as $key => $item) {
    $html .= '
                <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . htmlspecialchars($item['product_name']) . '</td>
                    <td class="text-right">Rp ' . number_format($item['price_at_sale'], 0, ',', '.') . '</td>
                    <td class="text-center">' . $item['qty'] . '</td>
                    <td class="text-right">Rp ' . number_format($item['subtotal'], 0, ',', '.') . '</td>
                </tr>';
}

$html .= '
            </tbody>
        </table>

        <h4>Cost Details</h4>
        <table class="no-border" style="width: 50%; float: right;">
            <tr>
                <td>Subtotal</td>
                <td class="text-right">Rp&nbsp;' . number_format($subtotal, 0, ',', '.') . '</td>
            </tr>
            <tr>
                <td>Service (5%)</td>
                <td class="text-right">Rp&nbsp;' . number_format($service_charge, 0, ',', '.') . '</td>
            </tr>
            <tr>
                <td>Taxes (10%)</td>
                <td class="text-right">Rp&nbsp;' . number_format($tax, 0, ',', '.') . '</td>
            </tr>';

if ($discount_amount > 0) {
    $html .= '
            <tr style="color: green; font-weight: bold;">
                <td>Discount (' . htmlspecialchars($order['discount_code']) . ')</td>
                <td class="text-right">-&nbsp;Rp&nbsp;' . number_format($discount_amount, 0, ',', '.') . '</td>
            </tr>';
}

$html .= '
            <tr class="total">
                <td><strong>GRAND TOTAL</strong></td>
                <td class="text-right"><strong>Rp&nbsp;' . number_format($order['total_amount'], 0, ',', '.') . '</strong></td>
            </tr>
        </table>

        <div style="clear: both;"></div>
        <div class="footer" style="text-align: center; margin-top: 40px; font-size: 12px; color: #777;">
            <p>Thank You For Your Purchase! &#128512;</p>
        </div>
    </div>
</body>
</html>
';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A5', 'portrait');

$dompdf->render();

$filename = 'Receipt-' . $order['order_code'] . '.pdf';
$dompdf->stream($filename, ['Attachment' => 0]);
exit();

?>