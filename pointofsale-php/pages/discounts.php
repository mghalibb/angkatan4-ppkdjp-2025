<?php
$query = mysqli_query($connection, "SELECT * FROM discounts ORDER BY is_active DESC, code ASC");
$discounts = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Discount Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Discount</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Discount Code List</h5>

          <div class="d-flex justify-content-end mb-3">
            <a href="index.php?page=tambah-discount" class="btn btn-primary">
              <i class="bi bi-plus-circle"></i> Add Discount
            </a>
          </div>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Type</th>
                <th scope="col">Value</th>
                <th scope="col">Status</th>
                <th scope="col">Expires</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($discounts as $key => $d): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><strong><?php echo htmlspecialchars($d['code']); ?></strong></td>
                  <td>
                    <?php if ($d['type'] == 'fixed'): ?>
                      <span class="badge bg-primary">Fixed (IDR)</span>
                    <?php else: ?>
                      <span class="badge bg-info text-dark">Percent (%)</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($d['type'] == 'fixed'): ?>
                      Rp <?php echo number_format($d['value'], 2, ',', '.'); ?>
                    <?php else: ?>
                      <?php echo $d['value'] * 100; ?>%
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($d['is_active']): ?>
                      <span class="badge bg-success">Active</span>
                    <?php else: ?>
                      <span class="badge bg-secondary">Inactive</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php echo !empty($d['expires_at']) ? date('d M Y H:i', strtotime($d['expires_at'])) : '-'; ?>
                  </td>
                  <td>
                    <a href="index.php?page=tambah-discount&edit=<?php echo $d['id'] ?>" class="btn btn-warning btn-sm"
                      title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="../pages/_actions/discount_action.php?action=delete&id=<?php echo $d['id'] ?>"
                      class="btn btn-danger btn-sm" title="Delete"
                      onclick="event.preventDefault(); confirmDelete(this.href);">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Type</th>
                <th scope="col">Value</th>
                <th scope="col">Status</th>
                <th scope="col">Expires</th>
                <th scope="col">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function confirmDelete(url) {
    Swal.fire({
      title: 'Anda yakin?',
      text: "This data cannot be recovered!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, Delete it!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed)
      {
        window.location.href = url;
      }
    });
  }
</script>