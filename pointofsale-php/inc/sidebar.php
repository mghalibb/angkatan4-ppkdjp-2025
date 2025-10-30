<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? '' : 'collapsed'; ?>"
        href="index.php?page=dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Master Data</li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['product', 'tambah-product'])) ? '' : 'collapsed'; ?>"
        href="index.php?page=product">
        <i class="bi bi-box-seam"></i>
        <span>Product</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['category', 'tambah-category'])) ? '' : 'collapsed'; ?>"
        href="index.php?page=category">
        <i class="bi bi-tags"></i>
        <span>Category</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['delivery', 'tambah-delivery'])) ? '' : 'collapsed'; ?>"
        href="index.php?page=delivery">
        <i class="bi bi-truck"></i>
        <span>Delivery</span>
      </a>
    </li>

    <li class="nav-heading">Transaction</li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'point-of-sale') ? '' : 'collapsed'; ?>"
        href="index.php?page=point-of-sale">
        <i class="bi bi-cart-plus"></i>
        <span>Place an Order</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php?page=discounts">
        <i class="bi bi-tag"></i>
        <span>Discount Management</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['order-list', 'order-details'])) ? '' : 'collapsed'; ?>"
        href="index.php?page=order-list">
        <i class="bi bi-file-earmark-text"></i>
        <span>Sales Report</span>
      </a>
    </li>

    <li class="nav-heading">Data Users</li>

    <li class="nav-item">
      <a class="nav-link <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['user', 'tambah-user', 'restore-user'])) ? '' : 'collapsed'; ?>"
        href="index.php?page=user">
        <i class="bi bi-people"></i>
        <span>Users</span>
      </a>
    </li>

    <li class="nav-heading">Other</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="../logout.php">
        <i class="bi bi-box-arrow-left"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>
</aside>