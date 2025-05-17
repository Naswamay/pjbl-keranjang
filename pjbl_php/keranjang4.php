<?php
$products = [
  ["id" => 1, "name" => "Garam Cap Udang", "price" => 5500, "image" => "images/garam.jpg"],
  ["id" => 2, "name" => "Mie Burung Dara", "price" => 5000, "image" => "images/mie.jpg"],
  ["id" => 3, "name" => "Beras Ramos", "price" => 74000, "image" => "images/beras.jpg"],
  ["id" => 4, "name" => "Minyak Kita", "price" => 15000, "image" => "images/minyak.jpg"],
  ["id" => 5, "name" => "Tepung Segitiga Biru", "price" => 12000, "image" => "images/tepung.jpg"],
  ["id" => 6, "name" => "Kecap Manis ABC", "price" => 9000, "addOn" => true, "image" => "images/kecap.jpg"],
  ["id" => 7, "name" => "Sarden ABC", "price" => 10000, "addOn" => true, "image" => "images/sarden.jpg"],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Keranjang Belanja - MANAN MART</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
    }
    .container {
      display: flex;
      flex: 1;
    }
    .left, .right {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }
    .left {
      border-right: 1px solid #ddd;
    }
    .header-box {
      font-weight: bold;
      font-size: 20px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .search-bar {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 15px;
      width: 100%;
    }
    .filter-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }
    .btn-filter {
      padding: 10px 15px;
      background: #eee;
      border: 1px solid #ccc;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      user-select: none;
    }
    .btn-filter.active {
      background: #fe9900;
      color: white;
      border-color: #e67e00;
    }
    .product {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 12px;
      margin-bottom: 12px;
      background-color: white;
    }
    .product > div:first-child {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .product img {
      width: 60px;
      height: 60px;
      border-radius: 6px;
      object-fit: cover;
    }
    .controls button {
      padding: 5px 12px;
      font-size: 16px;
      cursor: pointer;
      margin: 0 5px;
      border-radius: 5px;
      border: 1px solid #999;
      background: #f8f8f8;
    }
    .controls button:hover {
      background-color: #fe9900;
      color: white;
      border-color: #e67e00;
    }
    .controls span {
      min-width: 25px;
      text-align: center;
      display: inline-block;
      font-weight: bold;
      font-size: 16px;
    }
    .right h2 {
      margin-bottom: 15px;
    }
    #cart {
      flex-grow: 1;
      overflow-y: auto;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #eee;
      font-size: 16px;
    }
    .total {
      font-weight: bold;
      font-size: 22px;
      text-align: right;
      margin: 20px 0;
    }
    .btn-bayar {
      padding: 15px 20px;
      background-color: #fe9900;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    .btn-bayar:hover {
      background-color: #e67e00;
    }
    .payment-box {
      background: #fff9e5;
      border: 1px solid #fe9900;
      border-radius: 10px;
      padding: 15px;
      margin-top: 15px;
      display: none;
      flex-direction: column;
      gap: 10px;
    }
    .payment-box h3 {
      margin: 0 0 10px 0;
    }
    .payment-option {
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: pointer;
      font-weight: bold;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid transparent;
      transition: background-color 0.2s ease, border-color 0.2s ease;
    }
    .payment-option:hover {
      background-color: #fe9900;
      color: white;
      border-color: #e67e00;
    }
    .payment-option.selected {
      background-color: #e67e00;
      color: white;
      border-color: #b35f00;
    }
    .payment-option img {
      width: 30px;
      height: 30px;
      object-fit: contain;
    }
    .modal-total {
      text-align: right;
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="left">
      <div class="header-box">
        Pembelian
      </div>
      <input
        id="search"
        type="text"
        class="search-bar"
        placeholder="Cari nama barang..."
        oninput="cariProduk()"
      />
      <div class="filter-bar">
        <button class="btn-filter active" id="btn-semua" onclick="filterProducts('semua')">Semua</button>
        <button class="btn-filter" id="btn-addon" onclick="filterProducts('addon')">Add On</button>
      </div>
      <div id="product-list"></div>
    </div>

    <div class="right">
      <h2>Pembayaran</h2>
      <div id="cart"></div>
      <p class="total">Total: Rp <span id="total">0</span></p>

      <button class="btn-bayar" onclick="togglePaymentBox()">Bayar</button>

      <div id="payment-box" class="payment-box">
        <h3>Pilih Metode Pembayaran</h3>
        <div class="payment-option" onclick="selectPayment(this, 'Gopay')">
          <img src="943c971903518e53ffd324dd51e46a90.png" alt="Gopay" /> Gopay
        </div>
        <div class="payment-option" onclick="selectPayment(this, 'DANA')">
          <img src="2b1a7c6517b5efd9a5b48ad94ed4dc23-removebg-preview.png" alt="DANA" /> DANA
        </div>
        <div class="payment-option" onclick="selectPayment(this, 'ShopeePay')">
          <img src="ShopeePay New Logo.png" alt="ShopeePay" style="width: 50px;" /> ShopeePay
        </div>
        <div class="payment-option" onclick="selectPayment(this, 'BANK BRI')">
          <img src="images-removebg-preview.png" alt="BANK BRI" /> BANK BRI
        </div>
        <div class="payment-option" onclick="selectPayment(this, 'COD')">
          COD (Bayar di Tempat)
        </div>
        <div class="modal-total">Total Bayar: Rp <span id="modal-total">0</span></div>
      </div>
    </div>
  </div>

<script>
  // Produk dari PHP ke JS
  const products = <?php echo json_encode($products); ?>;
  let filteredProducts = [...products];
  let cart = {};
  let currentFilter = 'semua';

  function formatRupiah(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  function renderProducts() {
    const list = document.getElementById("product-list");
    list.innerHTML = "";

    filteredProducts.forEach((product) => {
      const div = document.createElement("div");
      div.className = "product";
      div.innerHTML = `
        <div>
          <img src="${product.image}" alt="${product.name}" />
          <div>${product.name} <br><small>Rp ${formatRupiah(product.price)}</small></div>
        </div>
        <div class="controls">
          <button onclick="addToCart(${product.id})">+</button>
          <span>${cart[product.id] || 0}</span>
          <button onclick="removeFromCart(${product.id})" ${!cart[product.id] ? "disabled" : ""}>-</button>
        </div>
      `;
      list.appendChild(div);
    });
  }

  function filterProducts(filter) {
    currentFilter = filter;
    // update tombol active
    document.getElementById("btn-semua").classList.toggle("active", filter === "semua");
    document.getElementById("btn-addon").classList.toggle("active", filter === "addon");

    if (filter === "semua") {
      filteredProducts = [...products];
    } else if (filter === "addon") {
      filteredProducts = products.filter(p => p.addOn);
    }
    // reset pencarian saat filter ganti
    document.getElementById("search").value = "";
    renderProducts();
  }

  function cariProduk() {
    const query = document.getElementById("search").value.toLowerCase();
    filteredProducts = products.filter(product => {
      const matchesFilter = currentFilter === "semua" ? true : product.addOn;
      return product.name.toLowerCase().includes(query) && matchesFilter;
    });
    renderProducts();
  }

  function addToCart(id) {
    cart[id] = (cart[id] || 0) + 1;
    updateCart();
    renderProducts();
  }

  function removeFromCart(id) {
    if (!cart[id]) return;
    cart[id]--;
    if (cart[id] <= 0) {
      delete cart[id];
    }
    updateCart();
    renderProducts();
  }

  function updateCart() {
    const cartDiv = document.getElementById("cart");
    cartDiv.innerHTML = "";

    let total = 0;

    for (const id in cart) {
      const product = products.find(p => p.id == id);
      if (!product) continue;
      const qty = cart[id];
      const subTotal = product.price * qty;
      total += subTotal;

      const div = document.createElement("div");
      div.className = "cart-item";
      div.textContent = `${product.name} x ${qty} = Rp ${formatRupiah(subTotal)}`;
      cartDiv.appendChild(div);
    }

    document.getElementById("total").textContent = formatRupiah(total);
    document.getElementById("modal-total").textContent = formatRupiah(total);

    // Disable bayar button if cart empty
    document.querySelector(".btn-bayar").disabled = total === 0;
  }

  // Payment box toggle & selection
  function togglePaymentBox() {
    const box = document.getElementById("payment-box");
    if (Object.keys(cart).length === 0) {
      alert("Keranjang kosong, silakan tambah produk terlebih dahulu.");
      return;
    }
    box.style.display = box.style.display === "flex" ? "none" : "flex";
  }

  let selectedPayment = null;
  function selectPayment(elem, method) {
    // Deselect all
    document.querySelectorAll(".payment-option").forEach(e => {
      e.classList.remove("selected");
    });
    elem.classList.add("selected");
    selectedPayment = method;
    alert(`Metode pembayaran dipilih: ${method}`);
  }

  // Inisialisasi tampilan produk dan cart saat pertama load
  filterProducts("semua");
  updateCart();
</script>

</body>
</html>
