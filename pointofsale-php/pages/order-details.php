<?php
// 1. Ambil ID Pesanan dari URL
if (!isset($_GET['order_id'])) {
  echo "<h1>Error: Order ID not found.</h1>";
  exit();
}
$order_id = (int) $_GET['order_id'];

// 2. Query untuk mengambil data pesanan utama
$stmt_order = mysqli_prepare($connection, "SELECT * FROM orders WHERE id = ?");
mysqli_stmt_bind_param($stmt_order, "i", $order_id);
mysqli_stmt_execute($stmt_order);
$order_result = mysqli_stmt_get_result($stmt_order);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
  echo "<h1>Error: Order not found.</h1>";
  exit();
}

// 3. Query untuk mengambil item-item yang dibeli (join dengan tabel products)
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

// 4. Hitung Subtotal manual dari item (untuk rincian biaya)
$subtotal = 0;
foreach ($items as $item) {
  $subtotal += $item['subtotal'];
}

// 5. Hitung rincian biaya lainnya (HARUS SAMA dengan logika di JS Anda)
$service_charge = $subtotal * 0.05; // Asumsi 5%
$taxable_amount = $subtotal + $service_charge;
$tax = $taxable_amount * 0.10; // Asumsi 10%
$discount_amount = (float) $order['discount_amount']; // Ambil dari database
?>

<div class="pagetitle">
  <h1>Order Details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=order-list">Sales Report</a></li>
      <li class="breadcrumb-item active">Details</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">

    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Purchased Items for <?php echo htmlspecialchars($order['order_code']); ?></h5>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col" class="text-center">Amount</th>
                <th scope="col" class="text-end">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $key => $item): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                  <td>Rp <?php echo number_format($item['price_at_sale'], 0, ',', '.'); ?></td>
                  <td class="text-center"><?php echo $item['qty']; ?></td>
                  <td class="text-end fw-bold">Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <a href="index.php?page=order-list" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Order List
          </a>

          <a href="../pages/_actions/receipt-printer.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary mt-3"
            target="_blank">
            <i class="bi bi-printer"></i> Download Receipt
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-4">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Order Information</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Order Date:</span>
              <span><?php echo date('d M Y, H:i', strtotime($order['order_date'])); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Payment Method:</span>
              <span class="fw-bold"><?php echo htmlspecialchars($order['payment_method']); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="text-muted">Status:</span>
              <?php
              // Logika status yang sama dari order-list.php
              $status = $order['order_status'];
              $orderTimestamp = strtotime($order['order_date']);
              $currentTimestamp = time();
              $timeoutMinutes = 15; // Samakan dengan di order-list
              $isExpired = ($currentTimestamp - $orderTimestamp) > ($timeoutMinutes * 60);

              if ($status == 1) {
                echo '<span class="badge bg-success">Finished</span>';
              } else if ($status != 1 && $isExpired) {
                echo '<span class="badge bg-danger">Canceled</span>';
              } else {
                echo '<span class="badge bg-warning">Pending</span>';
              }
              ?>
            </li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Cost Details</h5>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Subtotal:</span>
              <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Service (5%):</span>
              <span>Rp <?php echo number_format($service_charge, 0, ',', '.'); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Taxes (10%):</span>
              <span>Rp <?php echo number_format($tax, 0, ',', '.'); ?></span>
            </li>

            <?php if ($discount_amount > 0): ?>
              <li class="list-group-item d-flex justify-content-between text-success">
                <span class="fw-bold">Discount (<?php echo htmlspecialchars($order['discount_code']); ?>):</span>
                <span class="fw-bold">- Rp <?php echo number_format($discount_amount, 0, ',', '.'); ?></span>
              </li>
            <?php endif; ?>

            <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
              <h5 class="fw-bold mb-0">Grand Total:</h5>
              <h5 class="fw-bold text-primary mb-0">Rp <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>
              </h5>
            </li>
          </ul>

        </div>
      </div>

    </div>

  </div>
</section>