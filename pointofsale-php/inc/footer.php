<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>PPKD Jakarta Pusat</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">PPKD Jakarta Pusat 2025</a>
    </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Template Sweetalert2 JS File -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script src="../assets/js/password-toggle.js"></script>

<!-- Sweetalert2 JS File Path -->
<script src="../assets/js/sweetalert2.js"></script>

<!-- All Elements JS File Path -->
<script src="../assets/js/all-elements.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php
        $toastMessage = '';
        $toastIcon = '';
        $page = isset($_GET['page']) ? $_GET['page'] : '';

        // --- LOGIKA UNTUK MODUL USERS ---
        if ($page == 'user') {
            if (isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil') {
                $toastMessage = 'User Data Successfully Added!';
                $toastIcon = 'success';
            } else if (isset($_GET['ubah']) && $_GET['ubah'] == 'berhasil') {
                $toastMessage = 'User Data Successfully Changed!';
                $toastIcon = 'success';
            } else if (isset($_GET['hapus']) && $_GET['hapus'] == 'berhasil') {
                $toastMessage = 'User Data Successfully Moved To Recycle Bin!';
                $toastIcon = 'warning';
            } else if (isset($_GET['restore']) && $_GET['restore'] == 'berhasil') {
                $toastMessage = 'User Data Successfully Recovered!';
                $toastIcon = 'success';
            } else if (isset($_GET['hapus-permanen']) && $_GET['hapus-permanen'] == 'berhasil') {
                $toastMessage = 'User Data Successfully Deleted Permanently!';
                $toastIcon = 'error';
            }
        }

        // --- LOGIKA UNTUK MODUL PRODUK ---
        else if ($page == 'product') {
            if (isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil') {
                $toastMessage = 'New Product Successfully Added!';
                $toastIcon = 'success';
            } else if (isset($_GET['ubah']) && $_GET['ubah'] == 'berhasil') {
                $toastMessage = 'Product Data Successfully Changed!';
                $toastIcon = 'success';
            } else if (isset($_GET['hapus']) && $_GET['hapus'] == 'berhasil') {
                $toastMessage = 'Product Data Successfully Deleted!';
                $toastIcon = 'warning';
            }
        }

        // --- LOGIKA UNTUK MODUL KATEGORI ---
        else if ($page == 'category') {
            if (isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil') {
                $toastMessage = 'New Category Successfully Added!';
                $toastIcon = 'success';
            } else if (isset($_GET['ubah']) && $_GET['ubah'] == 'berhasil') {
                $toastMessage = 'Category Data Successfully Changed!';
                $toastIcon = 'success';
            } else if (isset($_GET['hapus']) && $_GET['hapus'] == 'berhasil') {
                $toastMessage = 'Category Data Successfully Deleted!';
                $toastIcon = 'warning';
            } else if (isset($_GET['error']) && $_GET['error'] == 'has_products') {
                $count = isset($_GET['count']) ? (int) $_GET['count'] : 0;
                // $toastMessage = "Failed to Delete! Masih ada {$count} produk terkait.";
                $toastMessage = "<strong>Failed to Delete!</strong> There still is <strong>{$count} Product</strong> Related to This Category.";
                $toastIcon = 'error';
            }
        }

        // --- LOGIKA UNTUK MODUL DISCOUNTS ---
        else if ($page == 'discounts') {
            if (isset($_GET['tambah']) && $_GET['tambah'] == 'berhasil') {
                $toastMessage = 'New Discount Code Successfully Added!';
                $toastIcon = 'success';
            } else if (isset($_GET['ubah']) && $_GET['ubah'] == 'berhasil') {
                $toastMessage = 'Discount Data Successfully Changed!';
                $toastIcon = 'success';
            } else if (isset($_GET['hapus']) && $_GET['hapus'] == 'berhasil') {
                $toastMessage = 'Discount Data Successfully Deleted!';
                $toastIcon = 'warning';
            }
        }

        if (!empty($toastMessage)) {
            echo "const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
              }
          });

            Toast.fire({
                icon: '{$toastIcon}',
                title: '{$toastMessage}'
            });

            const newUrl = window.location.pathname + '?page=' + '{$page}';
            window.history.replaceState({}, document.title, newUrl);
        ";
        }
        ?>
    });
</script>