<?php
$query = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_name ASC");
$categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Data Category</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Data Category</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Product Category List</h5>
          
          <div class="d-flex justify-content-end mb-3">
              <a href="index.php?page=tambah-category" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Category
              </a>
          </div>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $key => $value): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo htmlspecialchars($value['category_name']); ?></td>
                  <td>
                    <a href="index.php?page=tambah-category&edit=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="../pages/_actions/category_action.php?action=delete&id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="event.preventDefault(); confirmDelete(this.href);">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>