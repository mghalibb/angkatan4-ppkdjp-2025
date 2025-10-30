<?php
include 'conf/config.php';

$id = isset($_GET['edit']) ? (int)$_GET['edit'] : null;
$is_edit = !is_null($id);
$username = '';
$email = '';
$role_id_user = '';

// Ambil semua role untuk ditampilkan di dropdown
$q_roles = mysqli_query($connection, "SELECT * FROM roles");
$roles = mysqli_fetch_all($q_roles, MYSQLI_ASSOC);

// === PROSES FORM SAAT SUBMIT ===
if (isset($_POST['simpan'])) {
    $posted_id = $_POST['id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    if (empty($posted_id)) {
        // PROSES INSERT (TAMBAH)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($connection, "INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed_password, $role_id);
        mysqli_stmt_execute($stmt);
        header("location:user.php?tambah=berhasil");
    } else {
        // PROSES UPDATE (EDIT)
        if (!empty($password)) {
            // Jika password diisi, update password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, password=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $hashed_password, $role_id, $posted_id);
        } else {
            // Jika password kosong, jangan update password
            $stmt = mysqli_prepare($connection, "UPDATE users SET username=?, email=?, role_id=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssii", $username, $email, $role_id, $posted_id);
        }
        mysqli_stmt_execute($stmt);
        header("location:user.php?ubah=berhasil");
    }
    exit();
}

// === AMBIL DATA LAMA JIKA MODE EDIT ===
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $is_edit ? 'Edit' : 'Tambah' ?> User</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h1><?php echo $is_edit ? 'Edit' : 'Tambah' ?> User</h1>
    <form action="" method="post" class="form-grid">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      
      <label for="name">Nama *</label>
      <input type="text" id="name" name="name" placeholder="Masukkan Nama" required value="<?php echo htmlspecialchars($username); ?>">

      <label for="email">Email *</label>
      <input type="email" id="email" name="email" placeholder="Masukkan Email" required value="<?php echo htmlspecialchars($email); ?>">
      
      <label for="role_id">Role *</label>
      <select name="role_id" id="role_id" required>
        <option value="">-- Pilih Role --</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?php echo $role['id']; ?>" <?php echo ($role['id'] == $role_id_user) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($role['name']); ?>
            </option>
        <?php endforeach; ?>
      </select>

      <label for="password">Password *</label>
      <input type="password" id="password" name="password" placeholder="Masukkan Password" <?php if(!$is_edit) echo 'required'; ?>>
      <?php if($is_edit): ?><div style="grid-column: 2 / -1;"><small>Kosongkan jika tidak ingin mengubah password.</small></div><?php endif; ?>
      
      <div class="form-actions">
        <button type="submit" name="simpan" class="btn btn-primary">
            <?php echo $is_edit ? 'Simpan Perubahan' : 'Simpan' ?>
        </button>
      </div>
    </form>
</div>
</body>
</html>