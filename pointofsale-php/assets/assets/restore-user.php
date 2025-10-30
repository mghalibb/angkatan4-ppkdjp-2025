<?php
include 'conf/config.php';

if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $stmt = mysqli_prepare($connection, "DELETE FROM users WHERE id = ? AND delete_at IS NOT NULL");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  header("location:restore-user.php?hapus-permanen=berhasil");
  exit();
}

if (isset($_GET['restore'])) {
  $id = (int)$_GET['restore'];
  $stmt = mysqli_prepare($connection, "UPDATE users SET delete_at=NULL WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  header("location:user.php?restore=berhasil");
  exit();
}

$query = mysqli_query($connection, "SELECT u.*, r.name AS role_name FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.delete_at IS NOT NULL ORDER BY u.delete_at DESC");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tong Sampah Pengguna</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="header-actions">
        <div>
            <h1>Tong Sampah</h1>
            <p>Daftar pengguna yang telah dihapus.</p>
        </div>
        <a href="user.php" class="btn" style="background-color: #6c757d;"><- Kembali ke Daftar User</a>
    </div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $key => $value): ?>
        <tr>
          <td><?php echo $key + 1; ?></td>
          <td><?php echo htmlspecialchars($value['username']); ?></td>
          <td><?php echo htmlspecialchars($value['email']); ?></td>
          <td><?php echo htmlspecialchars($value['role_name'] ?? 'Tanpa Role'); ?></td>
          <td>
            <div class="action-pills">
                <a href="restore-user.php?restore=<?php echo $value['id'] ?>" class="action-edit" style="background-color:#cff6dd; color:#0a3622;" onclick="return confirm('Anda yakin akan mengembalikan user ini?')">Restore</a>
                <a onclick="return confirm('PERINGATAN: Data akan dihapus permanen dan tidak bisa dikembalikan. Lanjutkan?')" href="restore-user.php?delete=<?php echo $value['id'] ?>" class="action-delete">Hapus Permanen</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </tfoot>
    </table>
</div>
</body>
</html>