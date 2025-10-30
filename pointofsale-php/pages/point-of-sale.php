<?php
$q_categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_name ASC");
$categories = mysqli_fetch_all($q_categories, MYSQLI_ASSOC);

$q_products = mysqli_query($connection, "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.product_name ASC");

// $q_products = mysqli_query($connection, "SELECT * FROM products ORDER BY product_name ASC");
$products = mysqli_fetch_all($q_products, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1 id="pos-title">Point of Sale (POS)</h1>
</div>

<section class="section">
  <div class="pos-container">
    <div class="pos-sidebar">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Category</h5>
          <div class="list-group category-filter">
            <a href="#" class="list-group-item list-group-item-action active" data-category-id="all">All Menus</a>
            <?php foreach ($categories as $category): ?>
              <a href="#" class="list-group-item list-group-item-action"
                data-category-id="<?php echo $category['id']; ?>">
                <?php echo htmlspecialchars($category['category_name']); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="pos-products">
      <div class="product-grid">
        <?php foreach ($products as $product): ?>
          <div class="pos-product-card" data-category-id="<?php echo $product['category_id']; ?>"
            onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars(addslashes($product['product_name'])); ?>', <?php echo $product['price']; ?>)">
            <img
              src="../assets/uploads/<?php echo !empty($product['photo']) ? htmlspecialchars($product['photo']) : 'no-image.png'; ?>"
              alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            <div class="info">
              <div class="category">
                <?php echo htmlspecialchars($product['category_name']); ?>
              </div>

              <div class="name" title="<?php echo htmlspecialchars($product['product_name']); ?>">
                <?php echo htmlspecialchars($product['product_name']); ?>
              </div>
              <div class="price">Rp <?php echo number_format($product['price'], 2, ',', '.'); ?>,-</div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="pos-cart">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Order Details</h5>
          <div class="cart-items-container">
            <table class="table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody id="cart-items">
              </tbody>
            </table>
          </div>

          <hr>

          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="text-muted">Subtotal</h6>
            <h6 id="cart-subtotal" class="fw-bold">Rp 0</h6>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="text-muted">Taxes (10%)</h6>
            <h6 id="cart-tax" class="fw-bold">Rp 0</h6>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <h6 class="text-muted">Service Fee (5%)</h6>
            <h6 id="cart-service-charge" class="fw-bold">Rp 0</h6>
          </div>

          <hr class="my-2">

          <div class="input-group">
            <input type="text" id="discount-code" class="form-control form-control-sm"
              placeholder="Enter Discount Code">
            <button class="btn btn-outline-secondary btn-sm" type="button" id="apply-discount-btn">Apply</button>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-2 text-success d-none" id="discount-row">
            <h6 class="text-success">Discount</h6>
            <h6 id="cart-discount-amount" class="fw-bold">Rp 0</h6>
          </div>

          <hr class="my-2">

          <div class="d-flex justify-content-between align-items-center mt-2">
            <h5 class="fw-bold">Total:</h5>
            <h5 id="cart-total" class="cart-total-value fw-bold">Rp 0</h5>
          </div>

          <hr class="my-2">

          <!-- <form id="payment-form" action="../pages/_actions/process_order.php" method="POST"> -->
          <form id="payment-form" action="index.php?page=payment" method="POST">
            <div class="mb-3">
              <label for="payment-method" class="form-label">Payment Methods</label>
              <select class="form-select" id="payment-method" name="payment_method" required>
                <option value="QRIS" selected>QRIS</option>
                <option value="Cash">Cash</option>
                <option value="Debit Card">Debit Card</option>
              </select>
            </div>

            <input type="hidden" name="cart_data" id="cart-data-input">
            <input type="hidden" name="total_amount" id="total-amount-input">
            <input type="hidden" name="discount_code" id="discount-code-hidden" value="">

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
              <button type="button" class="btn btn-outline-danger1" onclick="clearCart()">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>