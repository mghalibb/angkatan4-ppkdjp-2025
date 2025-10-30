<?php
$id = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
$is_edit = !is_null($id);
$page_title = $is_edit ? 'Edit' : 'Add';

$d_code = '';
$d_type = 'fixed';
$d_value = '';
$d_is_active = 1;
$d_expires_at = '';

if ($is_edit) {
  $stmt = mysqli_prepare($connection, "SELECT * FROM discounts WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $d = mysqli_fetch_assoc($result);
  if ($d) {
    $d_code = $d['code'];
    $d_type = $d['type'];
    $d_value = $d['value'];
    $d_is_active = $d['is_active'];
    $d_expires_at = !empty($d['expires_at']) ? date('Y-m-d\TH:i', strtotime($d['expires_at'])) : '';
  }
}
?>

<div class="pagetitle">
  <h1><?php echo $page_title ?> Discount</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=discounts">Discount</a></li>
      <li class="breadcrumb-item active"><?php echo $page_title ?></li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $page_title ?> Discount Form</h5>

          <form action="../pages/_actions/discount_action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="row mb-3">
              <label for="code" class="col-sm-3 col-form-label">Discount Code</label>
              <div class="col-sm-9">
                <input type="text" id="code" name="code" class="form-control" required style="text-transform:uppercase"
                  value="<?php echo htmlspecialchars($d_code); ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="type" class="col-sm-3 col-form-label">Discount Type</label>
              <div class="col-sm-9">
                <select name="type" id="type" class="form-select" required>
                  <option value="fixed" <?php echo ($d_type == 'fixed') ? 'selected' : ''; ?>>Fixed (IDR Amount)</option>
                  <option value="percent" <?php echo ($d_type == 'percent') ? 'selected' : ''; ?>>Percent (%)
                  </option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="value" class="col-sm-3 col-form-label">Value</label>
              <div class="col-sm-9">
                <input type="number" id="value" name="value" step="0.01" class="form-control" required
                  value="<?php echo htmlspecialchars($d_value); ?>">
                <small class="form-text text-muted">
                  Example: If 'fixed', enter 10000. If 'percent' 15%, enter 0.15
                </small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="is_active" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <select name="is_active" id="is_active" class="form-select" required>
                  <option value="1" <?php echo ($d_is_active == 1) ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?php echo ($d_is_active == 0) ? 'selected' : ''; ?>>Inactive</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="expires_at" class="col-sm-3 col-form-label">Expires At</label>
              <div class="col-sm-9">
                <input type="datetime-local" id="expires_at" name="expires_at" class="form-control"
                  value="<?php echo htmlspecialchars($d_expires_at); ?>">
                <small class="form-text text-muted">
                  Leave blank if there is no expiration date.
                </small>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" name="simpan" class="btn btn-primary">
                  <?php echo $is_edit ? 'Save Changes' : 'Save Discount' ?>
                </button>
                <a href="index.php?page=discounts" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>