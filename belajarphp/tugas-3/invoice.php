<?php
require('fpdf.php');

if (isset($_GET['order_code'])) {
    $order_code = $_GET['order_code'];

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 10, 'INVOICE', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Order Code:', 0, 0);
    $pdf->Cell(0, 10, $order_code, 0, 1);

    $pdf->Cell(40, 10, 'Tanggal:', 0, 0);
    $pdf->Cell(0, 10, date('Y-m-d'), 0, 1);
    
    $pdf->Cell(40, 10, 'Status:', 0, 0);
    $pdf->Cell(0, 10, 'LUNAS (Contoh)', 0, 1);

    $pdf->Ln(20);
    $pdf->Cell(0, 10, 'Terima kasih telah berbelanja!', 0, 1, 'C');

    $pdf->Output('D', 'invoice-' . $order_code . '.pdf');

} else {
    die("Error: Kode Pesanan Tidak Ditemukan.");
}
?>