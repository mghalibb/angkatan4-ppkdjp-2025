<?php
$query = mysqli_query($connection, "SELECT u.*, r.name AS role_name FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.delete_at IS NOT NULL ORDER BY u.delete_at DESC");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>User Recycle Bin</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=user">User Data</a></li>
      <li class="breadcrumb-item active">Recycle Bin</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Deleted Users</h5>
          <div class="d-flex justify-content-end mb-3">
              <a href="index.php?page=user" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to User List
              </a>
          </div>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $key => $value): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo htmlspecialchars($value['username']); ?></td>
                  <td><?php echo htmlspecialchars($value['email']); ?></td>
                  <td><span class="badge bg-secondary"><?php echo htmlspecialchars($value['role_name'] ?? 'Tanpa Role'); ?></span></td>
                  <td>
                    <a href="../pages/_actions/user_action.php?action=restore&id=<?php echo $value['id'] ?>" class="btn btn-success btn-sm" title="Restore" onclick="return confirm('Are You Sure You Want to Return This User?')">
                      <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                    <a href="../pages/_actions/user_action.php?action=permanent_delete&id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm" title="Hapus Permanen" onclick="event.preventDefault(); confirmDelete(this.href);">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </tfoot>
          </table>
          </div>
      </div>
    </div>
  </div>
</section>