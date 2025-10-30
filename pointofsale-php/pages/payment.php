<?php
// --- 1. Ambil Data dari POST ---
$cart_json = $_POST['cart_data'] ?? '[]';
$cart_items = json_decode($cart_json, true);
$total_amount = (float) ($_POST['total_amount'] ?? 0);
$payment_method = htmlspecialchars($_POST['payment_method'] ?? 'N/A');
$discount_code = htmlspecialchars($_POST['discount_code'] ?? '');

// --- 2. Inisialisasi Variabel Perhitungan ---
$subtotal = 0;
$service_charge_rate = 0.05; // 5%
$tax_rate = 0.10; // 10%
$discount_amount = 0;
$discount_type = null;

// --- 3. Hitung Subtotal ---
foreach ($cart_items as $item) {
  $subtotal += $item['price'] * $item['qty'];
}

// --- 4. Hitung Biaya Layanan & Pajak ---
$service_charge = $subtotal * $service_charge_rate;
$taxable_amount = $subtotal + $service_charge;
$tax = $taxable_amount * $tax_rate;

// --- 5. Cek Diskon (ke database) ---
if (!empty($discount_code)) {
  $stmt = mysqli_prepare(
    $connection,
    "SELECT `type`, `value` FROM discounts 
         WHERE `code` = ? AND `is_active` = 1 AND (`expires_at` IS NULL OR `expires_at` > NOW())"
  );
  mysqli_stmt_bind_param($stmt, "s", $discount_code);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($discount = mysqli_fetch_assoc($result)) {
    $discount_type = $discount['type'];
    if ($discount['type'] == 'fixed') {
      $discount_amount = (float) $discount['value'];
    } else if ($discount['type'] == 'percent') {
      $discount_amount = $taxable_amount * (float) $discount['value'];
    }
  }
}
?>

<div class="pagetitle">
  <h1>Payment Confirmation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php?page=point-of-sale">Cashier</a></li>
      <li class="breadcrumb-item active">Payment</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-10">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Confirm Your Order</h5>
          <div class="row">
            <div class="col-md-7">
              <h6>Order Summary (<?php echo count($cart_items); ?> items)</h6>
              <ul class="list-group list-group-flush mb-3">
                <?php foreach ($cart_items as $item): ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      <span class="fw-bold"><?php echo $item['qty']; ?>x</span>
                      <?php echo htmlspecialchars($item['name']); ?>
                      <br>
                      <small class="text-muted">@ Rp <?php echo number_format($item['price'], 2, ',', '.'); ?>,-</small>
                    </div>
                    <span class="fw-bold">Rp
                      <?php echo number_format($item['price'] * $item['qty'], 2, ',', '.'); ?>,-</span>
                  </li>
                <?php endforeach; ?>
              </ul>

              <h6 class="mt-4">Cost Details</h6>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                  <span class="text-muted">Subtotal</span>
                  <span>Rp <?php echo number_format($subtotal, 2, ',', '.'); ?>,-</span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                  <span class="text-muted">Taxes (10%)</span>
                  <span>Rp <?php echo number_format($tax, 2, ',', '.'); ?>,-</span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                  <span class="text-muted">Service (5%)</span>
                  <span>Rp <?php echo number_format($service_charge, 2, ',', '.'); ?>,-</span>
                </li>

                <?php if ($discount_amount > 0): ?>
                  <li class="list-group-item d-flex justify-content-between text-success">
                    <span class="fw-bold">Discount (<?php echo htmlspecialchars($discount_code); ?>)</span>
                    <span class="fw-bold">- Rp <?php echo number_format($discount_amount, 2, ',', '.'); ?>,-</span>
                  </li>
                <?php endif; ?>
              </ul>
            </div>

            <div class="col-md-5 border-start">
              <div class="text-center">
                <h5 class="mb-3">Total Payment</h5>
                <h1 class="display-4 fw-bold text-primary text-center mb-3">Rp
                  <?php echo number_format($total_amount, 2, ',', '.'); ?>,-
                </h1>
                <p class="lead">Payment Method: <strong><?php echo $payment_method; ?></strong></p>

                <hr>

                <div class="payment-instruction my-4" style="min-height: 250px;">
                  <?php if ($payment_method == 'QRIS'): ?>
                    <h5 class="mb-3">Scan QR Code Below</h5>
                    <img src="../assets/img/qris-image.jpg" class="img-fluid" style="max-width: 250px;" alt="QRIS Code">

                  <?php elseif ($payment_method == 'Cash'): ?>
                    <h5 class="my-3">Please Pay Cash At The Counter</h5>
                    <p>Provide Cash Payment Of Rp <?php echo number_format($total_amount, 2, ',', '.'); ?>,- To The Cashier.
                    </p>
                    <i class="bi bi-cash-coin" style="font-size: 5rem; color: #198754;"></i>

                  <?php else: // Debit Card, etc. ?>
                    <h5 class="my-3">Please Tap/Swipe Your <?php echo $payment_method; ?></h5>
                    <p>Use the EDC machine provided.</p>
                    <i class="bi bi-credit-card" style="font-size: 5rem; color: #0d6efd;"></i>
                  <?php endif; ?>
                </div>

                <form action="../pages/_actions/process_order.php" method="POST">
                  <input type="hidden" name="cart_data" value="<?php echo htmlspecialchars($cart_json); ?>">
                  <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                  <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
                  <input type="hidden" name="discount_code" value="<?php echo htmlspecialchars($discount_code); ?>">
                  <input type="hidden" name="discount_amount" value="<?php echo $discount_amount; ?>">

                  <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                      Confirm & Complete Order
                    </button>

                    <a href="index.php?page=point-of-sale" class="btn btn-outline-danger1">
                      Cancel
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>