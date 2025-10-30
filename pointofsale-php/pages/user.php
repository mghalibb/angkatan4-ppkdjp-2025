<?php
$query = mysqli_query($connection, "SELECT u.*, r.name AS role_name FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.delete_at IS NULL ORDER BY u.role_id ASC");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>User Data</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">User Data</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Active User List</h5>

          <div class="d-flex justify-content-end mb-3">
            <a href="index.php?page=tambah-user" class="btn btn-primary me-2">
              <i class="bi bi-plus-circle"></i> Add User
            </a>
            <a href="index.php?page=restore-user" class="btn btn-secondary">
              <i class="bi bi-trash"></i> Recycle Bin
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
                  <td><span
                      class="badge bg-success"><?php echo htmlspecialchars($value['role_name'] ?? 'Tanpa Role'); ?></span>
                  </td>
                  <td>
                    <a href="index.php?page=tambah-user&edit=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm"
                      title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="../pages/_actions/user_action.php?action=soft_delete&id=<?php echo $value['id'] ?>"
                      onclick="event.preventDefault(); confirmDelete(this.href);" class="btn btn-danger btn-sm"
                      title="Hapus">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
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