<?php
$id = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
$is_edit = !is_null($id);
$username = '';
$email = '';
$role_id_user = '';

$q_roles = mysqli_query($connection, "SELECT * FROM roles ORDER BY name ASC");
$roles = mysqli_fetch_all($q_roles, MYSQLI_ASSOC);

if ($is_edit) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowEdit = mysqli_fetch_assoc($result);
    if ($rowEdit) {
        $username = $rowEdit['username'];
        $email = $rowEdit['email'];
        $role_id_user = $rowEdit['role_id'];
    }
}
?>

<div class="pagetitle">
  <h1><?php echo $is_edit ? 'Edit' : 'Add' ?> Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=user">User Data</a></li>
      <li class="breadcrumb-item active"><?php echo $is_edit ? 'Edit' : 'Add' ?></li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $is_edit ? 'Edit Form' : 'Add Form' ?> Users</h5>

          <form action="../pages/_actions/user_action.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" id="name" name="name" class="form-control" required value="<?php echo htmlspecialchars($username); ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" id="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($email); ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="role_id" class="col-sm-2 col-form-label">Role</label>
              <div class="col-sm-10">
                <select name="role_id" id="role_id" class="form-select" required>
                  <option value="">-- Pilih Role --</option>
                  <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['id']; ?>" <?php echo ($role['id'] == $role_id_user) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($role['name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <div class="input-group password-toggle-group"> 
                  <input type="password" id="password" name="password" class="form-control" <?php if (!$is_edit) echo 'required'; ?>>
                  <span class="input-group-text toggle-password-btn" style="cursor: pointer;">
                    <i class="bi bi-eye-slash"></i>
                  </span>
                </div>
                <?php if ($is_edit): ?>
                  <small class="form-text text-muted">Leave Blank If You Don't Want To Change The Password..</small>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="submit" name="simpan" class="btn btn-primary">
                  <?php echo $is_edit ? 'Save Changes' : 'Save User' ?>
                </button>
                <a href="index.php?page=user" class="btn btn-secondary">Cancelled</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>