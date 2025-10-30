function confirmDelete(url) {
  Swal.fire({
    title: 'Are You Sure?',
    text: 'Deleted Data Cannot Be Recovered!!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, Delete This Data!',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Deleted!!',
        text: 'This Data Has Been Deleted!!',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false,
      }).then(() => {
        // window.location = "data-produk/delete-data-product.php?id_produk=" + id_produk;
        window.location.href = url;
      });
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  var productDetailsModal = document.getElementById('productDetailsModal');
  if (productDetailsModal) {
    productDetailsModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;

      var name = button.getAttribute('data-name');
      var category = button.getAttribute('data-category');
      var price = button.getAttribute('data-price');
      var product_description = button.getAttribute('data-description');
      var imgSrc = button.getAttribute('data-img');

      var modalTitle = productDetailsModal.querySelector('.modal-title');
      var modalImage = productDetailsModal.querySelector('#modalProductImage');
      var modalCategory = productDetailsModal.querySelector('#modalProductCategory');
      var modalPrice = productDetailsModal.querySelector('#modalProductPrice');
      var modalDescription = productDetailsModal.querySelector('#modalProductDescription');

      modalTitle.textContent = name;
      modalImage.src = imgSrc;
      modalCategory.textContent = category;
      modalPrice.textContent = price;
      modalDescription.textContent = product_description;
    });
  }
});
