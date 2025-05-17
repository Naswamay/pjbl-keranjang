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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keranjang Belanja</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
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
      box-sizing: border-box;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }
    .left {
      border-right: 1px solid #ccc;
    }
    .header-box {
      display: flex;
      align-items: center;
      background-color: #f1f1f1;
      padding: 10px 15px;
      border-radius: 8px;
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 18px;
    }
    .back-button {
      background: none;
      border: none;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      margin-right: 10px;
      padding: 5px 10px;
    }
    .back-button:hover {
      background-color: #ddd;
      border-radius: 5px;
    }
    .search-bar {
      padding: 10px;
      width: 97%;
      border: 1px solid #ccc;
      border-radius:5px;
      margin-bottom: 10px;
    }
    .menu-bar {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 10px;
    }
    .menu-bar a {
      color: #2b7;
      text-decoration: none;
      font-weight: bold;
    }
    .filter-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }
    .btn-filter {
      padding: 10px 12px;
      background-color: #eee;
      border: 1px solid #ccc;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-filter:hover {
      background-color: #ddd;
    }
    .product {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .controls button {
      margin: 0 5px;
    }
    .total {
      font-weight: bold;
      font-size: 25px;
      text-align: right;
      margin-top: 20px;
    }
    .btn {
      padding: 10px 10px;
      background-color: #5e8198;
      color: white;
      border: none;
      border-radius: 1px;
      cursor: pointer;
      width: 100%;
      margin-top: auto;
      font-size: 20px;
    }
    .payment-box {
      background: #f8f8f8;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 15px;
      margin-top: 15px;
      display: none;
    }
    .payment-box h3 {
      margin-top: 0;
      font-size: 18px;
    }
    .payment-option {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
      font-size: 16px;
      cursor: pointer;
    }
    .payment-option img {
      width: 30px;
      height: 30px;
    }
    .modal-total {
      text-align: right;
      font-weight: bold;
      font-size: 16px;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="header-box">
        <button class="back-button" onclick="hideModal()">←</button>
        Pembelian
      </div>
      <input id="search" class="search-bar" type="text" placeholder="Cari nama barang" oninput="cariProduk()" />
      <div class="menu-bar">
        <a href="#">Tambah Barang Baru</a>
      </div>
      <div class="filter-bar">
        <button onclick="filterProducts('semua')" class="btn-filter">Semua</button>
        <button onclick="filterProducts('addon')" class="btn-filter">Add On</button>
      </div>
      <div id="product-list"></div>
    </div>

    <div class="right">
      <h2>Pembayaran</h2>
      <div id="cart"></div>
      <p class="total">Total: Rp <span id="total">0</span></p>

      <div id="payment-box" class="payment-box">
        <h3>Pilih Metode Pembayaran</h3>
        <div class="payment-option" onclick="selectPayment('Gopay')"><img src="943c971903518e53ffd324dd51e46a90.png" alt="gopay">Gopay</div>
        <div class="payment-option" onclick="selectPayment('DANA')"><img src="2b1a7c6517b5efd9a5b48ad94ed4dc23-removebg-preview.png" alt="dana">DANA</div>
        <div class="payment-option" onclick="selectPayment('ShopeePay')"><img src="ShopeePay New Logo.png" alt="shopeepay" style="width: 50px;">ShopeePay</div>
        <div class="payment-option" onclick="selectPayment('BANK BRI')"><img src="images-removebg-preview.png" alt="bri">BANK BRI</div>
        <div class="payment-option" onclick="selectPayment('COD')">COD (Bayar di Tempat)</div>
        <div class="modal-total">Total: Rp <span id="modal-total">0</span></div>
      </div>
        <div class="kotakk">
          
           <button class="btn" onclick="showModal()">Bayar</button>
       </div>
    </div>
  </div>

  <script>
    const products = <?php echo json_encode($products); ?>;
    let currentFilter = "semua";
    const cart = {};

    function filterProducts(mode) {
      currentFilter = mode;
      cariProduk();
    }

    function cariProduk() {
      const keyword = document.getElementById("search").value.toLowerCase();
      const list = document.getElementById("product-list");
      list.innerHTML = "";

      let filtered = products;
      if (currentFilter === "addon") {
        filtered = products.filter(p => p.addOn);
      }

      const hasil = filtered.filter(p => p.name.toLowerCase().includes(keyword));

      hasil.forEach(product => {
        const el = document.createElement("div");
        el.className = "product";
        el.innerHTML = `
          <div style="display: flex; gap: 15px; align-items: center;">
            <img src="${product.image}" alt="${product.name}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
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

    function renderCart() {
      const cartEl = document.getElementById("cart");
      cartEl.innerHTML = "";
      let total = 0;
      for (const id in cart) {
        const product = products.find(p => p.id == id);
        const jumlah = cart[id];
        const harga = jumlah * product.price;
        total += harga;
        const el = document.createElement("div");
        el.className = "cart-item";
        el.innerHTML = `
          <div>${jumlah} x ${product.name}</div>
          <div>Rp ${harga.toLocaleString("id-ID")}</div>
        `;
        cartEl.appendChild(el);
      }
      document.getElementById("total").innerText = total.toLocaleString("id-ID");
      document.getElementById("modal-total").innerText = total.toLocaleString("id-ID");
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

    function showModal() {
      document.getElementById("payment-box").style.display = "block";
    }

    function hideModal() {
      document.getElementById("payment-box").style.display = "none";
    }

    function selectPayment(method) {
      alert(`Metode Pembayaran yang dipilih: ${method}`);
      hideModal();
    }

    cariProduk();
    renderCart();
  </script>
</body>
</html>
