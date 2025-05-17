<?php
$products = [
  ["name" => "Garam Cap Udang", "weight" => "250 gr", "price" => "Rp.5.500,00", "stock" => 77, "desc" => "Memiliki kandungan yodium dan bisa digunakan untuk memasak/ditaburkan pada makanan agar menambah cita rasa.", "img" => "garam.png"],
  ["name" => "Mi Burung Dara", "weight" => "85 gr", "price" => "Rp.5.000,00", "stock" => 60, "desc" => "Mi instan lezat dan gurih, cocok untuk segala suasana.", "img" => "mibd.png"],
  ["name" => "Beras Ramos", "weight" => "5 kg", "price" => "Rp.74.000,00", "stock" => 34, "desc" => "Beras pilihan dengan kualitas premium untuk nasi yang pulen.", "img" => "beras.png"],
  ["name" => "Minyak Kita", "weight" => "1 liter", "price" => "Rp.15.000,00", "stock" => 100, "desc" => "Minyak goreng sehat dan hemat untuk kebutuhan dapur Anda.", "img" => "minyak.png"],
  ["name" => "Tepung Segitiga Biru", "weight" => "1 kg", "price" => "Rp.12.000,00", "stock" => 55, "desc" => "Tepung terigu serbaguna untuk aneka olahan makanan.", "img" => "tepung.png"],
  ["name" => "Gulaku", "weight" => "1 kg", "price" => "Rp.17.000,00", "stock" => 80, "desc" => "Gula pasir putih berkualitas untuk kebutuhan harian.", "img" => "gulaku.png"]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MANAN MART</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #fff3d8;
    }
    header {
      background-color: #f7931e;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .logo {
      font-size: 28px;
      font-weight: bold;
      margin-left: 20px;
    }
    .search-bar {
      flex-grow: 1;
      margin: 0 20px;
    }
    .search-bar input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
    }
    .icons {
      margin-right: 20px;
    }
    .container {
      padding: 20px;
    }
    .section {
      margin-bottom: 40px;
    }
    .section h2 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .product-list {
      display: flex;
      gap: 20px;
      overflow-x: auto;
    }
    .product {
      text-align: center;
      border: 2px solid black;
      border-radius: 10px;
      padding: 10px;
      width: 130px;
      background-color: #fff;
      cursor: pointer;
    }
    .product img {
      max-width: 100%;
      height: auto;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.8);
      background-color: #fef4d3;
      padding: 20px;
      border: 3px solid gray;
      border-radius: 20px;
      z-index: 1000;
      width: 320px;
      opacity: 0;
      transition: all 0.3s ease-in-out;
    }
    .modal.show {
      display: block;
      opacity: 1;
      transform: translate(-50%, -50%) scale(1);
    }
    .modal-content {
      display: flex;
      gap: 15px;
      align-items: flex-start;
    }
    .modal img {
      width: 120px;
      border-radius: 10px;
    }
    .modal-details {
      flex: 1;
    }
    .modal h3, .modal p {
      margin: 5px 0;
    }
    .modal .btn {
      background-color: orange;
      color: black;
      padding: 10px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }
    .modal-close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 18px;
      font-weight: bold;
      background: none;
      border: none;
      cursor: pointer;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
      display: none;
    }
    .overlay.show {
      display: block;
      animation: fadeIn 0.3s forwards;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">MANAN MART</div>
    <div class="search-bar">
      <input type="text" placeholder="Cari Di MANAN MART">
    </div>
    <div class="icons">🛒 💬</div>
  </header>

  <div class="container">
    <div class="section">
      <h2>Barang Yang Di Jual</h2>
      <div class="product-list">
        <?php foreach ($products as $p): ?>
        <div class="product" onclick='showModal(<?php echo json_encode($p); ?>)'>
          <img src="img/<?php echo $p["img"] ?>" alt="<?php echo $p["name"] ?>">
          <br><strong><?php echo $p["name"] ?></strong><br><?php echo $p["price"] ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section">
      <h2>Paling Sering Di Beli</h2>
      <div class="product-list">
        <?php foreach ($products as $p): ?>
        <div class="product" onclick='showModal(<?php echo json_encode($p); ?>)'>
          <img src="img/<?php echo $p["img"] ?>" alt="<?php echo $p["name"] ?>">
          <br><strong><?php echo $p["name"] ?></strong><br><?php echo $p["price"] ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="overlay" id="overlay" onclick="closeModal()"></div>
  <div class="modal" id="productModal">
    <button class="modal-close" onclick="closeModal()">✖</button>
    <div class="modal-content">
      <img id="modalImage" src="" alt="">
      <div class="modal-details">
        <h3 id="modalTitle"></h3>
        <p id="modalWeight"></p>
        <p style="color: red; font-weight: bold;" id="modalPrice"></p>
        <p id="modalDesc"></p>
        <p id="modalStock"></p>
        <button class="btn" onclick="closeModal()">Masukkan Keranjang</button>
      </div>
    </div>
  </div>

  <script>
    function showModal(p) {
      document.getElementById("modalImage").src = 'img/' + p.img;
      document.getElementById("modalTitle").innerText = p.name;
      document.getElementById("modalWeight").innerText = p.weight;
      document.getElementById("modalPrice").innerText = p.price;
      document.getElementById("modalDesc").innerText = p.desc;
      document.getElementById("modalStock").innerText = `Stok ${p.stock}`;

      const modal = document.getElementById("productModal");
      const overlay = document.getElementById("overlay");

      overlay.classList.add("show");
      modal.classList.add("show");
    }

    function closeModal() {
      const modal = document.getElementById("productModal");
      const overlay = document.getElementById("overlay");

      modal.classList.remove("show");
      overlay.classList.remove("show");

      setTimeout(() => {
        modal.style.display = "none";
      }, 300);
    }
  </script>
</body>
</html>
