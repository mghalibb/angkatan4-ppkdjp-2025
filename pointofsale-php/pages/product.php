<?php
$query = mysqli_query($connection, "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.product_name ASC");
$products = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Product Data</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Product Data</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Product List</h5>

          <div class="d-flex justify-content-end mb-3">
            <a href="index.php?page=tambah-product" class="btn btn-primary">
              <i class="bi bi-plus-circle"></i> Add Product
            </a>
          </div>

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $key => $product): ?>
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                  <td><span
                      class="badge bg-info text-dark"><?php echo htmlspecialchars($product['category_name']); ?></span>
                  </td>
                  <td>Rp <?php echo number_format($product['price'], 2, ',', '.'); ?></td>
                  <td>
                    <button type="button" class="btn btn-info btn-sm" title="Lihat Detail" data-bs-toggle="modal"
                      data-bs-target="#productDetailsModal"
                      data-name="<?php echo htmlspecialchars($product['product_name']); ?>"
                      data-category="<?php echo htmlspecialchars($product['category_name']); ?>"
                      data-price="Rp <?php echo number_format($product['price'], 2, ',', '.'); ?>"
                      data-description="<?php echo htmlspecialchars($product['product_description'] ?? 'No Description.'); ?>"
                      data-img="<?php echo !empty($product['photo']) ? '../assets/uploads/' . $product['photo'] : '../assets/img/no-image.png'; ?>">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                  <td>
                    <?php if (!empty($product['photo'])): ?>
                      <img src="../assets/uploads/<?php echo $product['photo'] ?>"
                        alt="<?php echo $product['product_name'] ?>" width="100">
                    <?php else: ?>
                      <span class="text-muted small">No Images Here</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="index.php?page=tambah-product&edit=<?php echo $product['id'] ?>"
                      class="btn btn-warning btn-sm" title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="../pages/_actions/product_action.php?action=delete&id=<?php echo $product['id'] ?>"
                      class="btn btn-danger btn-sm" title="Hapus"
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
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProductName">Product Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <img id="modalProductImage" src="" class="img-fluid rounded" alt="Foto Produk">
          </div>
          <div class="col-md-8">
            <table class="table table-sm">
              <tr>
                <th>Category</th>
                <td><span id="modalProductCategory" class="badge bg-info text-dark"></span></td>
              </tr>

              <tr>
                <th>Price</th>
                <td id="modalProductPrice"></td>
              </tr>

              <tr>
                <th>Description</th>
                <td id="modalProductDescription" class="text-justify"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Closed</button>
      </div>
    </div>
  </div>
</div>