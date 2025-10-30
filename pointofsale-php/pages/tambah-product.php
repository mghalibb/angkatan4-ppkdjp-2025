<?php
$id = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
$is_edit = !is_null($id);
$product_name = '';
$price = '';
$category_id = '';
$current_photo = '';
$product_description = '';

$q_categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_name ASC");
$categories = mysqli_fetch_all($q_categories, MYSQLI_ASSOC);

if ($is_edit) {
  $stmt = mysqli_prepare($connection, "SELECT * FROM products WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $product = mysqli_fetch_assoc($result);
  if ($product) {
    $product_name = $product['product_name'];
    $price = $product['price'];
    $category_id = $product['category_id'];
    $current_photo = $product['photo'];
    $product_description = $product['product_description'];
  }
}
?>

<div class="pagetitle">
  <h1><?php echo $is_edit ? 'Edit' : 'Add' ?> Product</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=product">Product Data</a></li>
      <li class="breadcrumb-item active"><?php echo $is_edit ? 'Edit' : 'Add' ?></li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $is_edit ? 'Edit Form' : 'Add Form' ?> Product</h5>

          <form action="../pages/_actions/product_action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="row mb-3">
              <label for="product_name" class="col-sm-2 col-form-label">Product name</label>
              <div class="col-sm-10">
                <input type="text" id="product_name" name="product_name" class="form-control" required
                  value="<?php echo htmlspecialchars($product_name); ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="category_id" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10">
                <select name="category_id" id="category_id" class="form-select" required>
                  <option value="">-- Select Category --</option>
                  <?php foreach ($categories as $c): ?>
                    <option value="<?php echo $c['id'] ?>" <?php echo ($c['id'] == $category_id) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($c['category_name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="price" class="col-sm-2 col-form-label">Price</label>
              <div class="col-sm-10">
                <input type="number" id="price" name="price" step="0.01" class="form-control" required
                  value="<?php echo htmlspecialchars($price); ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="product_description" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <textarea id="product_description" name="product_description" class="form-control"
                  style="height: 100px"><?php echo htmlspecialchars($product_description); ?></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label for="photo" class="col-sm-2 col-form-label">Product Photos</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                <?php if ($is_edit && !empty($current_photo)): ?>
                  <small class="form-text text-muted">Current Photo:</small><br>
                  <img src="../assets/uploads/<?php echo $current_photo; ?>" width="150" class="mt-2">
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" name="simpan" class="btn btn-primary">
                  <?php echo $is_edit ? 'Simpan Perubahan' : 'Simpan Produk' ?>
                </button>
                <a href="index.php?page=product" class="btn btn-secondary">Cancelled</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>