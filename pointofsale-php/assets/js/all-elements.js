/*--------------------------------------------------------------
# Point Of Sale JS
--------------------------------------------------------------*/
let cart = [];
let appliedDiscount = {
  code: '',
  type: null,
  value: 0,
};

function addToCart(id, name, price) {
  const existingProduct = cart.find((item) => item.id === id);
  if (existingProduct) {
    existingProduct.qty++;
  } else {
    cart.push({ id, name, price, qty: 1 });
  }
  renderCart();
}

function updateQty(id, change) {
  const product = cart.find((item) => item.id === id);
  if (product) {
    product.qty += change;
    if (product.qty <= 0) {
      removeFromCart(id);
    } else {
      renderCart();
    }
  }
}

function removeFromCart(id) {
  cart = cart.filter((item) => item.id !== id);
  renderCart();
}

function renderCart() {
  const cartBody = document.getElementById('cart-items');
  cartBody.innerHTML = '';

  // MODIFIKASI: 'total' di sini sekarang menjadi 'subtotal'
  let subtotal = 0;

  cart.forEach((item) => {
    // MODIFIKASI: Ganti nama variabel agar tidak bingung
    const itemSubtotal = item.price * item.qty;
    subtotal += itemSubtotal;

    const row = `
      <tr>
          <td>
            <div class="fw-bold">${item.name}</div>
            <small class="text-muted">${formatRupiah(item.price)}</small>
          </td>

          <td class="text-center align-middle">
            <div class="input-group input-group-sm justify-content-center">
              <button class="btn btn-outline-secondary" type="button" onclick="updateQty(${
                item.id
              }, -1)">-</button>
              <input type="text" class="form-control text-center" value="${
                item.qty
              }" readonly style="max-width: 35px;">
              <button class="btn btn-outline-secondary" type="button" onclick="updateQty(${
                item.id
              }, 1)">+</button>
            </div>
          </td>

          <td class="text-end align-middle">${formatRupiah(itemSubtotal)}</td>
            
          <td class="align-middle text-center">
            <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${
              item.id
            })" title="Hapus item">
              <i class="bi bi-x-lg"></i>
            </button>
          </td>
      </tr>
    `;
    cartBody.innerHTML += row;
  });

  // =======================================
  // --- MULAI LOGIKA KALKULASI BARU ---
  // =======================================
  const SERVICE_CHARGE_RATE = 0.05; // 5%
  const TAX_RATE = 0.1; // 10%

  const serviceCharge = subtotal * SERVICE_CHARGE_RATE;
  const taxableAmount = subtotal + serviceCharge;
  const tax = taxableAmount * TAX_RATE;

  // --- Logika Diskon (dari variabel global) ---
  let discountAmount = 0;
  const discountRow = document.getElementById('discount-row');
  const discountAmountEl = document.getElementById('cart-discount-amount');

  if (appliedDiscount.type === 'fixed') {
    discountAmount = appliedDiscount.value;
    discountRow.classList.remove('d-none');
    discountAmountEl.innerText = '-' + formatRupiah(discountAmount);
  } else if (appliedDiscount.type === 'percent') {
    discountAmount = taxableAmount * appliedDiscount.value;
    discountRow.classList.remove('d-none');
    discountAmountEl.innerText = '-' + formatRupiah(discountAmount);
  } else {
    discountRow.classList.add('d-none');
  }

  // --- Hitung Total Akhir ---
  let total = taxableAmount + tax - discountAmount;
  if (total < 0) total = 0;

  // --- Update semua elemen HTML ---
  document.getElementById('cart-subtotal').innerText = formatRupiah(subtotal);
  document.getElementById('cart-service-charge').innerText = formatRupiah(serviceCharge);
  document.getElementById('cart-tax').innerText = formatRupiah(tax);
  document.getElementById('cart-total').innerText = formatRupiah(total);

  // Update hidden input
  document.getElementById('cart-data-input').value = JSON.stringify(cart);
  document.getElementById('total-amount-input').value = total;

  const discountCodeInput = document.getElementById('discount-code-hidden');
  if (discountCodeInput) {
    discountCodeInput.value = appliedDiscount.code;
  }
  // =======================================
  // --- AKHIR LOGIKA KALKULASI BARU ---
  // =======================================
}

// MODIFIKASI: Fungsi clearCart()
function clearCart() {
  cart = [];

  document.getElementById('discount-code').value = '';
  appliedDiscount = { code: '', type: null, value: 0 };

  renderCart();
}

// MODIFIKASI: Ganti nama 'numberWithCommas' menjadi 'formatRupiah'
function formatRupiah(number) {
  number = Math.round(number);
  return 'Rp ' + number.toLocaleString('id-ID');
}

// === Category Filter Script ===
document.addEventListener('DOMContentLoaded', function () {
  const categoryLinks = document.querySelectorAll('.category-filter .list-group-item');
  const productCards = document.querySelectorAll('.pos-product-card');

  categoryLinks.forEach((link) => {
    link.addEventListener('click', function (event) {
      event.preventDefault();

      categoryLinks.forEach((l) => l.classList.remove('active'));
      this.classList.add('active');

      const selectedCategoryId = this.getAttribute('data-category-id');

      productCards.forEach((card) => {
        const productCategoryId = card.getAttribute('data-category-id');

        if (selectedCategoryId === 'all' || productCategoryId === selectedCategoryId) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // =======================================
  // --- MULAI BLOK LOGIKA DISKON ---
  // =======================================
  const applyBtn = document.getElementById('apply-discount-btn');
  const discountInput = document.getElementById('discount-code');
  const paymentForm = document.getElementById('payment-form');

  async function applyDiscount() {
    const code = discountInput.value.trim().toUpperCase();

    if (code === '') {
      appliedDiscount = { code: '', type: null, value: 0 };
      renderCart();
      return;
    }

    try {
      const response = await fetch(`../pages/_actions/check_discount.php?code=${code}`);
      const data = await response.json();

      if (data.success) {
        appliedDiscount = {
          code: code,
          type: data.type,
          value: data.value,
        };
      } else {
        appliedDiscount = { code: '', type: null, value: 0 };
        alert(data.message);
      }
    } catch (error) {
      console.error('Error:', error);
      alert('An Error Occurred While Checking The Code.');
    }

    renderCart();
  }

  if (applyBtn) {
    applyBtn.addEventListener('click', applyDiscount);
  }

  if (discountInput) {
    discountInput.addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        applyDiscount();
      }
    });
  }

  if (paymentForm) {
    paymentForm.addEventListener('submit', function (event) {
      if (cart.length === 0) {
        event.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Empty Basket!',
          text: 'You Must Add At Least One Product To Checkout!!',
        });
      }
    });
  }
  // =======================================
  // --- AKHIR BLOK LOGIKA DISKON ---
  // =======================================
});
// === Category Filter Script ===

/*--------------------------------------------------------------
# Point Of Sale JS
--------------------------------------------------------------*/
