<?php
$id = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
$is_edit = !is_null($id);
$category_name = '';

if ($is_edit) {
  $stmt = mysqli_prepare($connection, "SELECT category_name FROM categories WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $category = mysqli_fetch_assoc($result);
  $category_name = $category['category_name'];
}
?>

<div class="pagetitle">
  <h1><?php echo $is_edit ? 'Edit' : 'Add' ?> Category</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=category">Category Data</a></li>
      <li class="breadcrumb-item active"><?php echo $is_edit ? 'Edit' : 'Add' ?></li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $is_edit ? 'Edit Form' : 'Add Form' ?> Category</h5>

          <?php
          if (isset($_GET['error']) && $_GET['error'] == 'kosong') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Failed to Save!</strong> The Category Name Cannot Be Empty.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
          }
          ?>

          <form action="../pages/_actions/category_action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
              <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
              <div class="col-sm-10">
                <input type="text" id="category_name" name="category_name" class="form-control" required
                  value="<?php echo htmlspecialchars($category_name); ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" name="simpan" class="btn btn-primary">
                  <?php echo $is_edit ? 'Simpan Perubahan' : 'Simpan Kategori' ?>
                </button>
                <a href="index.php?page=category" class="btn btn-secondary">Cancelled</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>