<?php
$query = mysqli_query($connection, "SELECT * FROM orders ORDER BY order_date DESC");
$orders = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Sales Report</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Sales Report</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of All Transactions</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Order Code</th>
                <th scope="col">Date</th>
                <th scope="col">Total Shopping</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Discount</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $key => $order): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo htmlspecialchars($order['order_code']); ?></td>
                  <td><?php echo date('d M Y, H:i', strtotime($order['order_date'])); ?></td>
                  <td><strong>Rp <?php echo number_format($order['total_amount'], 2, ',', '.'); ?>,-</strong></td>
                  <td>
                    <?php echo htmlspecialchars($order['payment_method']); ?>
                  </td>

                  <td>
                    <?php if (!empty($order['discount_code'])): ?>
                      <span class="badge bg-info text-dark"><?php echo htmlspecialchars($order['discount_code']); ?></span>
                      <br>
                      <small class="text-success fw-bold">-Rp
                        <?php echo number_format($order['discount_amount'], 2, ',', '.'); ?>,-</small>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                    $status = $order['order_status'];
                    $orderTimestamp = strtotime($order['order_date']);
                    $currentTimestamp = time();
                    $timeoutMinutes = 15;

                    $isExpired = ($currentTimestamp - $orderTimestamp) > ($timeoutMinutes * 60);

                    if ($status == 1) {
                      echo '<span class="badge bg-success">Finished</span>';
                    } else if ($status != 1 && $isExpired) {
                      echo '<span class="badge bg-danger">Canceled</span>';
                    } else {
                      echo '<span class="badge bg-warning">Pending</span>';
                    }
                    ?>
                  </td>
                  <td>
                    <a href="index.php?page=order-details&order_id=<?php echo $order['id']; ?>"
                      class="btn btn-info btn-sm" title="View Details">
                      <i class="bi bi-eye"></i>
                    </a>

                    <?php
                    $status = $order['order_status'];
                    $orderTimestamp = strtotime($order['order_date']);
                    $currentTimestamp = time();
                    $timeoutMinutes = 15;
                    $isExpired = ($currentTimestamp - $orderTimestamp) > ($timeoutMinutes * 60);

                    if ($status == 1) {
                    } else if ($status != 1 && $isExpired) {
                      ?>
                        <span class="btn btn-danger btn-sm disabled" title="Canceled">
                          <i class="bi bi-x-circle-fill"></i>
                        </span>
                      <?php
                    } else {
                      ?>
                        <a href="../pages/_actions/update_order_status.php?action=mark_paid&id=<?php echo $order['id']; ?>"
                          class="btn btn-success btn-sm" title="Mark as Paid">
                          <i class="bi bi-check-circle"></i>
                        </a>
                      <?php
                    }
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <th scope="col">No</th>
              <th scope="col">Order Code</th>
              <th scope="col">Date</th>
              <th scope="col">Total Shopping</th>
              <th scope="col">Payment Method</th>
              <th scope="col">Discount</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>