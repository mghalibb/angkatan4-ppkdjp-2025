<?php
session_start();
require_once '../../assets/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include '../../conf/config.php';

$logo_path = dirname(__DIR__, 2) . '/assets/img/coffee-logo.jpg';
$logo_type = pathinfo($logo_path, PATHINFO_EXTENSION);
$logo_data = file_get_contents($logo_path);
$logo_base64 = 'data:image/' . $logo_type . ';base64,' . base64_encode($logo_data);

if (!isset($_GET['order_id'])) {
    die("Error: Order ID Not Found.");
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

$cashier_name = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'N/A';

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
        @page {
            margin: 8px;
        }

        body { 
            font-family: \'Courier New\', Courier, monospace; 
            margin: 0;
            font-size: 8pt;
            color: #000;

        }

        .receipt-container { 
            width: 100%;
        }

        .header { 
            text-align: center; 
            margin-bottom: 5px; 
            margin-top: 10px; 
        }

        .header img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .header h1 { 
            margin: 0; 
            font-size: 14pt; 
            font-weight: bold;
        }

        .header p { 
            margin: 0; 
            font-size: 9pt; 
        }
        
        .info-table { 
            width: 100%; 
            font-size: 9pt;
            margin-bottom: 5px;
        }

        .info-table td { 
            padding: 1px 0;
        }
        
        .items-table { 
            width: 100%; 
            border-collapse: collapse; 
        }
            
        .items-table thead tr {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .items-table th { 
            padding: 3px 0;
            text-align: left;
            font-weight: bold;
        }

        .items-table td { 
            padding: 2px 0; 
            vertical-align: top;
        }
        
        .item-row-main td {
             padding-top: 3px;
        }
             
        .item-row-price td {
            padding-bottom: 3px;
            border-bottom: 1px dotted #000;
        }
        
        .totals-table {
            width: 100%;
            margin-top: 5px;
        }

        .totals-table tr.main-total {
            font-size: 11pt; 
            font-weight: bold;
        }

        .totals-table tr.main-total td {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            margin: 4px 0;
            padding: 3px 0; 
        }

        .totals-table tr.payment-details {
             border-top: 1px dotted #000;
        }

        .totals-table td {
            padding: 1px 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 8pt;
        }

        .footer span {
            font-weight: bold;
        }
        
        .text-right { 
            text-align: right; 
        }

        .text-left { 
            text-align: left; 
        }

        .text-center { 
            text-align: center; 
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <img src="' . $logo_base64 . '" alt="Logo"><br>
            <h1>Mochastack Coffee</h1>
            <p>Jl. Gerbang Pemuda No.3 Lantai LG, RT.1/RW.3, Gelora, Kec, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270</p>
            <p>087-7833-2323</p>
        </div>

        <table class="info-table">
            <tr>
                <td>' . date('d M Y', strtotime($order['order_date'])) . '</td>
                <td class="text-right">' . date('H:i', strtotime($order['order_date'])) . '</td>
            </tr>
            <tr>
                <td>Transaction ID</td>
                <td class="text-right">#' . substr($order['order_code'], -8) . '</td>
            </tr>
            <tr>
                <td>Cashier</td>
                <td class="text-right">' . $cashier_name . '</td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="text-right" style="font-weight:bold;">' . strtoupper($status_text) . '</td>
            </tr>
        </table>

        <table class="items-table" style="margin-bottom: 2px;">
            <thead>
                <tr>
                    <th class="text-left" style="width: 80%;">ITEM</th>
                <th class="text-right" style="width: 20%;">TOTAL</th>
                </tr>
            </thead>
        </table>

        <table class="items-table" style="border-bottom: 1px dashed #000; margin-bottom: 5px;">
        <tbody>';
foreach ($items as $item) {
    $html .= '
                <tr class="item-row-main">
                <td style="width: 70%;">' . htmlspecialchars($item['product_name']) . '</td>
                <td class="text-right" style="width: 30%;">Rp&nbsp;' . number_format($item['subtotal'], 0, ',', '.') . '</td>
            </tr>
            <tr class="item-row-price">
                <td class="text-left" colspan="2">&nbsp;&nbsp; ' . $item['qty'] . 'x @Rp&nbsp;' . number_format($item['price_at_sale'], 0, ',', '.') . '</td>
            </tr>';
}
$html .= '
            </tbody>
        </table>

        <table class="totals-table">
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
                <tr>
                    <td>Discount (' . htmlspecialchars($order['discount_code']) . ')</td>
                    <td class="text-right">-&nbsp;Rp&nbsp;' . number_format($discount_amount, 0, ',', '.') . '</td>
                </tr>';
}

$html .= '
                <tr>
                    <td style="padding-top: -50px;">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>';

$html .= '
            <tr class="main-total">
                <td><strong>Total</strong></td>
                <td class="text-right">Rp&nbsp;' . number_format($order['total_amount'], 0, ',', '.') . '</td>
            </tr>
            
            <tr class="payment-details">
                <td style="padding-top: 10px;">' . htmlspecialchars($order['payment_method']) . '</td>
                <td class="text-right" style="padding-top: 10px;">Rp&nbsp;' . number_format($order['total_amount'], 0, ',', '.') . '</td> </tr>
            <tr>
                <td>Change</td>
                <td class="text-right">Rp&nbsp;0</td> </tr>
        </table>

        <div class="footer">
            <p>Thank You for Visiting &#128512;</p>
            <p>Follow Us On Instagram <span>@Mochastack Coffee</span></p>
            <p>Have a Nice Day &#128155;</p>
        </div>
    </div>
</body>
</html>
';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('dpi', 96);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper([0, 0, 227, 842], 'portrait');

$dompdf->render();

$filename = 'Receipt-' . $order['order_code'] . '.pdf';
$dompdf->stream($filename, ['Attachment' => 0]); // 0 = Tampilkan, 1 = Download
exit();

?>