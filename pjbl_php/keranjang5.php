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
      background: #fff9e5;
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
      background: white;
      border-radius: 10px;
      margin: 15px;
      box-shadow: 0 0 10px #ddd;
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
      color: #fe9900;
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
      transition: background-color 0.3s ease;
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
      box-shadow: 1px 1px 4px #eee;
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
      transition: background-color 0.3s ease;
    }
    .controls button:hover:not(:disabled) {
      background-color: #fe9900;
      color: white;
      border-color: #e67e00;
    }
    .controls button:disabled {
      opacity: 0.4;
      cursor: not-allowed;
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
      color: #fe9900;
    }
    #cart {
      flex-grow: 1;
      overflow-y: auto;
      border-top: 1px solid #eee;
      padding-top: 10px;
      margin-bottom: 10px;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #eee;
      font-size: 16px;
      align-items: center;
    }
    .cart-item span.name {
      flex: 1;
    }
    .cart-item span.qty {
      margin: 0 15px;
      font-weight: bold;
    }
    .total-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff9e5;
      border: 1px solid #fe9900;
      border-radius: 10px;
      padding: 10px 15px;
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 18px;
      color: #333;
    }
    /* Hapus voucher section */
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
      margin-top: 5px;
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
      color: #fe9900;
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
      user-select: none;
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
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="header-box">Pembelian</div>
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
      <h2>Keranjang Belanja</h2>
      <div id="cart"></div>
      <div class="total-section">
        <span>Total Harga:</span>
        <span id="total-harga">Rp 0</span>
      </div>

      <!-- Tombol klaim voucher bisa diarahkan ke halaman lain -->
      <button onclick="window.location.href='klaim-voucher.php'" style="margin-bottom:10px; padding: 10px 15px; background:#fe9900; border:none; color:white; border-radius:5px; cursor:pointer; font-weight:bold;">Klaim Voucher</button>

      <button class="btn-bayar" onclick="togglePaymentBox()">Bayar</button>
      <div class="payment-box" id="payment-box">
        <h3>Pilih Metode Pembayaran</h3>
        <div class="payment-option" onclick="selectPayment(this)">
          <img src="images/payment-dana.png" alt="Dana" /> Dana
        </div>
        <div class="payment-option" onclick="selectPayment(this)">
          <img src="images/payment-gopay.png" alt="GoPay" /> GoPay
        </div>
        <div class="payment-option" onclick="selectPayment(this)">
          <img src="images/payment-ovo.png" alt="ShopePay" /> ShoopePay
        </div>
        <div class="payment-option" onclick="selectPayment(this)">
          <img src="images/payment-ovo.png" alt="Bank BRI" /> Bank BRI
        </div>
         <div class="payment-option" onclick="selectPayment(this)">
          <img src="images/payment-ovo.png" alt="COD" /> COD
        </div>
        <div class="modal-total" id="modal-total">Total Bayar: Rp 0</div>
      </div>
    </div>
  </div>

  <script>
    const products = <?php echo json_encode($products); ?>;

    let cart = {};
    let currentFilter = "semua";

    function formatRupiah(angka) {
      return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function renderProducts(filtered = products) {
      const productList = document.getElementById("product-list");
      productList.innerHTML = "";

      if (filtered.length === 0) {
        productList.innerHTML = "<p>Produk tidak ditemukan.</p>";
        return;
      }

      filtered.forEach(p => {
        const productDiv = document.createElement("div");
        productDiv.className = "product";

        const prodHtml = `
          <div>
            <img src="${p.image}" alt="${p.name}" />
            <div>
              <div style="font-weight:bold;">${p.name}</div>
              <div style="color:#555;">${formatRupiah(p.price)}</div>
            </div>
          </div>
          <div class="controls">
            <button onclick="updateCart(${p.id}, -1)" ${!cart[p.id] ? "disabled" : ""}>-</button>
            <span>${cart[p.id] || 0}</span>
            <button onclick="updateCart(${p.id}, 1)">+</button>
          </div>
        `;

        productDiv.innerHTML = prodHtml;
        productList.appendChild(productDiv);
      });
    }

    function updateCart(id, change) {
      if (!cart[id]) cart[id] = 0;
      cart[id] += change;
      if (cart[id] < 0) cart[id] = 0;

      if (cart[id] === 0) delete cart[id];

      renderProducts(filterProducts(currentFilter));
      renderCart();
    }

    function renderCart() {
      const cartContainer = document.getElementById("cart");
      cartContainer.innerHTML = "";

      let total = 0;
      for (const id in cart) {
        const qty = cart[id];
        const product = products.find(p => p.id == id);
        const subtotal = qty * product.price;
        total += subtotal;

        const cartItem = document.createElement("div");
        cartItem.className = "cart-item";
        cartItem.innerHTML = `
          <span class="name">${product.name}</span>
          <span class="qty">${qty} x</span>
          <span class="subtotal">${formatRupiah(subtotal)}</span>
        `;
        cartContainer.appendChild(cartItem);
      }

      document.getElementById("total-harga").textContent = formatRupiah(total);
      document.getElementById("modal-total").textContent = "Total Bayar: " + formatRupiah(total);
    }

    function cariProduk() {
      const keyword = document.getElementById("search").value.toLowerCase();
      const filtered = products.filter(p => p.name.toLowerCase().includes(keyword));
      currentFilter = "semua"; // reset filter button highlight
      resetFilterButtons();
      renderProducts(filtered);
    }

    function filterProducts(type) {
      currentFilter = type;
      resetFilterButtons();

      let filtered;
      if (type === "semua") {
        filtered = products;
        document.getElementById("btn-semua").classList.add("active");
      } else if (type === "addon") {
        filtered = products.filter(p => p.addOn);
        document.getElementById("btn-addon").classList.add("active");
      }
      renderProducts(filtered);
      return filtered;
    }

    function resetFilterButtons() {
      document.getElementById("btn-semua").classList.remove("active");
      document.getElementById("btn-addon").classList.remove("active");
    }

    function togglePaymentBox() {
      const box = document.getElementById("payment-box");
      if (Object.keys(cart).length === 0) {
        alert("Keranjang kosong, silakan pilih produk terlebih dahulu.");
        return;
      }
      box.style.display = box.style.display === "flex" ? "none" : "flex";
    }

    function selectPayment(el) {
      const options = document.querySelectorAll(".payment-option");
      options.forEach(opt => opt.classList.remove("selected"));
      el.classList.add("selected");
      alert("Metode pembayaran dipilih: " + el.textContent.trim());
    }

    // Init
    filterProducts("semua");
    renderCart();
  </script>
</body>
</html>
