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
  <title>Keranjang Belanja</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .container {
      display: flex;
      flex: 1;
    }
    .left, .right {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      position: relative;
    }
    .left {
      border-right: 1px solid #ddd;
    }
    .right {
      padding-bottom: 70px; /* beri ruang bawah supaya tombol bayar tidak nutup konten */
    }
    .header-box {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .back-button {
      background: none;
      border: none;
      font-size: 24px;
      margin-right: 10px;
      cursor: pointer;
    }
    .search-bar {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .menu-bar {
      margin-bottom: 15px;
    }
    .menu-bar a {
      text-decoration: none;
      color: #2b7;
      font-weight: bold;
    }
    .filter-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }
    .btn-filter {
      padding: 8px 14px;
      border: 1px solid #bbb;
      border-radius: 20px;
      cursor: pointer;
      background-color: #f0f0f0;
    }
    .btn-filter:hover {
      background-color: #ddd;
    }
    .product {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 15px;
      background-color: #fff;
      box-shadow: 1px 1px 3px rgba(0,0,0,0.05);
    }
    .product img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 6px;
    }
    .controls button {
      padding: 4px 8px;
      font-size: 16px;
      margin: 0 5px;
      cursor: pointer;
    }
    .right h2 {
      margin-bottom: 15px;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      font-size: 16px;
    }
    .total {
      font-weight: bold;
      font-size: 22px;
      text-align: right;
      margin: 20px 0;
    }
    .btn-bayar {
      position: fixed;
      bottom: 15px;
      right: 15px;
      padding: 15px 25px;
      background-color: #2b7;
      color: white;
      border: none;
      border-radius: 30px;
      font-size: 18px;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: background-color 0.3s ease;
    }
    .btn-bayar:hover {
      background-color: #1a5c3a;
    }
    .payment-box {
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 15px;
      margin-top: 15px;
      border-radius: 10px;
      display: none;
      max-width: 350px;
    }
    .payment-box h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .payment-option {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 0;
      cursor: pointer;
    }
    .payment-option img {
      width: 30px;
      height: 30px;
    }
    .voucher-box {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 16px;
      margin: 20px 0 10px;
    }
    .voucher-icon {
      width: 24px;
      height: 24px;
    }
    .modal-total {
      text-align: right;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="header-box">
        <button class="back-button" onclick="hideModal()">←</button>
        <h3>Pembelian</h3>
      </div>
      <input type="text" class="search-bar" placeholder="Cari nama barang" id="search" oninput="cariProduk()">
      <div class="menu-bar">
        <a href="#">Tambah Barang Baru</a>
      </div>
      <div class="filter-bar">
        <button class="btn-filter" onclick="filterProducts('semua')">Semua</button>
        <button class="btn-filter" onclick="filterProducts('addon')">Add On</button>
      </div>
      <div id="product-list"></div>
    </div>
    <div class="right">
      <h2>Pembayaran</h2>
      <div id="cart"></div>
      <p class="total">Total: Rp <span id="total">0</span></p>

      <div id="payment-box" class="payment-box">
        <h3>Pilih Metode Pembayaran</h3>
        <div class="payment-option" onclick="selectPayment('Gopay')">
          <img src="943c971903518e53ffd324dd51e46a90.png" alt="Gopay"> Gopay
        </div>
        <div class="payment-option" onclick="selectPayment('DANA')">
          <img src="2b1a7c6517b5efd9a5b48ad94ed4dc23-removebg-preview.png" alt="DANA"> DANA
        </div>
        <div class="payment-option" onclick="selectPayment('ShopeePay')">
          <img src="ShopeePay New Logo.png" alt="ShopeePay" style="width: 50px;"> ShopeePay
        </div>
        <div class="payment-option" onclick="selectPayment('BANK BRI')">
          <img src="images-removebg-preview.png" alt="BANK BRI"> BANK BRI
        </div>
        <div class="payment-option" onclick="selectPayment('COD')">
          COD (Bayar di Tempat)
        </div>
        <div class="modal-total">Total: Rp <span id="modal-total">0</span></div>
      </div>

      <div class="voucher-box">
        <div style="display:flex; align-items:center; gap:8px;">
          <img src="cbdf1efd-4591-429b-95f6-fc185544b509.png" class="voucher-icon" alt="Voucher">
          <span>Gunakan Voucher</span>
        </div>
    </div>
  </div>

  <button class="btn-bayar" onclick="showModal()">Bayar</button>

  <script>
    const products = <?php echo json_encode($products); ?>;
    const cart = {};
    let currentFilter = "semua";

    function cariProduk() {
      const keyword = document.getElementById("search").value.toLowerCase();
      const list = document.getElementById("product-list");
      list.innerHTML = "";
      let filtered = products;

      if (currentFilter === "addon") {
        filtered = filtered.filter(p => p.addOn);
      }

      filtered = filtered.filter(p => p.name.toLowerCase().includes(keyword));

      filtered.forEach(product => {
        const el = document.createElement("div");
        el.className = "product";
        el.innerHTML = `
          <div style="display:flex; gap:10px; align-items:center;">
            <img src="${product.image}" alt="${product.name}">
            <div>
              <strong>${product.name}</strong><br>
              Rp ${product.price.toLocaleString("id-ID")}
            </div>
          </div>
          <div class="controls">
            <button onclick="kurang(${product.id})">−</button>
            <span id="jumlah-${product.id}">${cart[product.id] || 0}</span>
            <button onclick="tambah(${product.id})">+</button>
          </div>
        `;
        list.appendChild(el);
      });
    }

    function filterProducts(mode) {
      currentFilter = mode;
      cariProduk();
    }

    function tambah(id) {
      cart[id] = (cart[id] || 0) + 1;
      document.getElementById(`jumlah-${id}`).innerText = cart[id];
      renderCart();
    }

    function kurang(id) {
      if (cart[id]) {
        cart[id]--;
        if (cart[id] <= 0) delete cart[id];
        document.getElementById(`jumlah-${id}`).innerText = cart[id] || 0;
        renderCart();
      }
    }

    function renderCart() {
      const el = document.getElementById("cart");
      el.innerHTML = "";
      let total = 0;
      for (const id in cart) {
        const product = products.find(p => p.id == id);
        const jumlah = cart[id];
        const harga = jumlah * product.price;
        total += harga;
        const item = document.createElement("div");
        item.className = "cart-item";
        item.innerHTML = `${jumlah} x ${product.name}<div>Rp ${harga.toLocaleString("id-ID")}</div>`;
        el.appendChild(item);
      }
      document.getElementById("total").innerText = total.toLocaleString("id-ID");
      document.getElementById("modal-total").innerText = total.toLocaleString("id-ID");
    }

    function showModal() {
      document.getElementById("payment-box").style.display = "block";
    }

    function hideModal() {
      document.getElementById("payment-box").style.display = "none";
    }

    function selectPayment(method) {
      alert("Metode Pembayaran: " + method);
      hideModal();
    }

    cariProduk();
    renderCart();
  </script>
</body>
</html>
