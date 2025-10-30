<?php
include 'conf/config.php';

// Soft Delete (pindah ke "tong sampah")
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $stmt = mysqli_prepare($connection, "UPDATE users SET delete_at=now() WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  header("location:user.php?hapus=berhasil");
  exit();
}

// Query untuk mengambil user yang aktif (delete_at IS NULL)
$query = mysqli_query($connection, "SELECT u.*, r.name AS role_name FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.delete_at IS NULL ORDER BY u.id ASC");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pengguna</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="header-actions">
        <div>
            <h1>Daftar Pengguna Aktif</h1>
            <p>Daftar semua pengguna yang aktif.</p>
        </div>
        <div>
            <a href="tambah-user.php" class="btn btn-primary" style="margin-right:10px;">Tambah User</a>
            <a href="restore-user.php" class="btn" style="background-color: #6c757d;">Tong Sampah</a>
        </div>
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
                <a href="tambah-user.php?edit=<?php echo $value['id'] ?>" class="action-edit">Edit</a>
                <a onclick="return confirm('Anda yakin ingin memindahkan user ini ke tong sampah?')" href="user.php?delete=<?php echo $value['id'] ?>" class="action-delete">Hapus</a>
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