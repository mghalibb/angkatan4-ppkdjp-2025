<?php
$orders = [
  [
    'id' => 1,
    'order_code' => 'AB-2025-01-02',
    'order_date' => '2025-01-02 08:17:11',
    'amount' => 56000,
    'status' => 'payment',
    "file" => "file-5.pdf"
  ],
  [
    'id' => 2,
    'order_code' => 'AC-2025-01-02',
    'order_date' => '2025-01-02 08:50:33',
    'amount' => 70000,
    'status' => 'payment',
    "file" => "file-5.pdf"
  ],
  [
    'id' => 3,
    'order_code' => 'AD-2025-01-02',
    'order_date' => '2025-01-02 10:50:33',
    'amount' => 0,
    'status' => 'order',
    "file" => "file-5.pdf"
  ],
  [
    'id' => 4,
    'order_code' => 'AE-2025-01-02',
    'order_date' => '2025-01-02 15:30:33',
    'amount' => 40000,
    'status' => 'payment',
    "file" => "file-5.pdf"
  ],
  [
    'id' => 5,
    'order_code' => 'AF-2025-01-04',
    'order_date' => '2025-01-04 15:30:33',
    'amount' => 0,
    'status' => 'order',
    "file" => "file-5.pdf"
  ]
];

$status_mapping = [
  'payment' => 'status-payment',
  'order' => 'status-order',
  // 'shipped' => 'status-shipped',
];
$order_details = [
  [
    "id" => 1,
    "order_id" => 1,
    "product_name" => "Bakmie Jawa Jawa Jawa",
    "qty" => 1,
    "order_price" => 25000,
    "order_subtotal" => 25000
  ],
  [
    "id" => 2,
    "order_id" => 1,
    "product_name" => "Teh Botol",
    "qty" => 1,
    "order_price" => 31000,
    "order_subtotal" => 31000
  ],
  [
    "id" => 3,
    "order_id" => 2,
    "product_name" => "Nasi Goreng",
    "qty" => 1,
    "order_price" => 30000,
    "order_subtotal" => 30000
  ],
  [
    "id" => 4,
    "order_id" => 2,
    "product_name" => "Kopi",
    "qty" => 1,
    "order_price" => 30000,
    "order_subtotal" => 30000
  ],
  [
    "id" => 5,
    "order_id" => 2,
    "product_name" => "Kue",
    "qty" => 1,
    "order_price" => 10000,
    "order_subtotal" => 10000
  ],
  [
    "id" => 6,
    "order_id" => 3,
    "product_name" => "Ketoprak",
    "qty" => 1,
    "order_price" => 20000,
    "order_subtotal" => 20000
  ],
  [
    "id" => 7,
    "order_id" => 3,
    "product_name" => "Teh Botol",
    "qty" => 1,
    "order_price" => 31000,
    "order_subtotal" => 31000
  ],
  [
    "id" => 8,
    "order_id" => 4,
    "product_name" => "Air Mineral",
    "qty" => 1,
    "order_price" => 40000,
    "order_subtotal" => 40000
  ],
  [
    "id" => 9,
    "order_id" => 5,
    "product_name" => "Air Tajin",
    "qty" => 1,
    "order_price" => 7000,
    "order_subtotal" => 7000
  ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Data Payment</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="container-fluid my-3">
    <h2 class="text-center fw-bold">Membuat Tabel</h2>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-title fw-bold">Data Payment</div>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Order Code</th>
                  <th>Order Date</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Actions</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $order): ?>
                  <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['order_code']); ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>Rp. <?php echo number_format($order['amount'], 0, ',', '.'); ?></td>
                    <td>
                      <?php
                      $current_status = $order['status'];
                      $status_class = $status_mapping[$current_status];
                      ?>
                      <span class="status <?php echo $status_class; ?>">
                        <?php echo htmlspecialchars($order['status']); ?>
                      </span>
                    </td>
                    <!-- <td>
                      <a href="invoice.php?order_code=<?php// echo urlencode($order['order_code']); ?>"
                        class="btn btn-danger" target="_blank">
                        Print Struk
                      </a>
                    </td> -->
                    <td>
                      <?php
                      if (pathinfo($order['file'], PATHINFO_EXTENSION) == "jpg") {
                        ?>
                        <img src="assets/img/<?php echo $order['file'] ?>" width="100" alt="img">
                        <?php
                      } elseif (pathinfo($order['file'], PATHINFO_EXTENSION) == "pdf") {
                        ?>
                        <a href="assets/img/<?php echo $order['file'] ?>" class="btn btn-danger" target="_blank">Print
                          Struk</a>
                        <?php
                      }
                      ?>
                    </td>
                    <td><a href="print.php?idPrint=<?php echo $order['id'] ?>" target="_blank"
                        class="btn btn-danger">PRINT STRUK</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <th>No.</th>
                <th>Order Code</th>
                <th>Order Date</th>
                <th>Order Amount</th>
                <th>Order Status</th>
                <th>Actions</th>
                <th>Actions</th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
    crossorigin="anonymous"></script>
</body>

</html>