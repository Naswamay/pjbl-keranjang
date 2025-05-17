<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manan Mart</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #fef6e4;
    }

    .header {
      background-color: #fca311;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: black;
    }

    .search-container {
      flex: 1;
      margin: 0 20px;
    }

    .search-container input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
    }

    .icon-group {
      display: flex;
      gap: 20px;
      font-size: 20px;
    }

    .section {
      background-color: #fef6e4;
      padding: 20px;
    }

    h2 {
      margin-bottom: 10px;
    }

    .produk-container {
      display: flex;
      gap: 20px;
      overflow-x: auto;
    }

    .produk {
      background-color: #fff;
      border-radius: 10px;
      text-align: center;
      padding: 10px;
      width: 150px;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .produk img {
      width: 100%;
      height: 120px;
      object-fit: contain;
    }

    .produk .nama {
      margin-top: 10px;
      font-weight: bold;
      font-size: 14px;
    }

    .produk .harga {
      font-size: 13px;
      color: #444;
    }

    /* Modal */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 9;
    }

    .modal {
      display: none;
      position: fixed;
      top: 10%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #fef6e4;
      border-radius: 15px;
      width: 320px;
      padding: 20px;
      z-index: 10;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }

    .modal img {
      width: 100%;
      border-radius: 10px;
    }

    .modal .judul {
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
    }

    .modal .berat, .modal .stok {
      font-size: 14px;
    }

    .modal .harga {
      color: red;
      font-size: 16px;
      margin: 5px 0;
    }

    .modal .deskripsi {
      margin-top: 10px;
      font-size: 14px;
    }

    .modal button {
      margin-top: 15px;
      background-color: #fca311;
      border: none;
      padding: 10px;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
    }

    .modal .close-btn {
      position: absolute;
      top: 10px; right: 15px;
      font-size: 20px;
      cursor: pointer;
    }

  </style>
</head>
<body>

<div class="header">
  <div class="logo">MANAN MART</div>
  <div class="search-container">
    <input type="text" placeholder="Cari di MANAN MART" />
  </div>
  <div class="icon-group">
    🛒 💬
  </div>
</div>

<div class="section">
  <h2>Barang Yang Dijual</h2>
  <div class="produk-container">
    <div class="produk" onclick="bukaModal('garam.jpg','Garam Cap Udang', 'Rp.5.500,00', '250 gr', 'Memiliki kandungan yodium dan bisa digunakan untuk memasak/ditaburkan pada makanan agar menambah cita rasa.', 77)">
      <img src="garam.jpg" alt="Garam Cap Udang">
      <div class="nama">GARAM CAP UDANG</div>
      <div class="harga">Rp.5.500,00</div>
    </div>
    <!-- Tambahkan lebih banyak produk sesuai kebutuhan -->
  </div>
</div>

<!-- MODAL -->
<div class="overlay" id="overlay" onclick="tutupModal()"></div>

<div class="modal" id="modal">
  <span class="close-btn" onclick="tutupModal()">×</span>
  <img id="modal-img" src="">
  <div class="judul" id="modal-nama"></div>
  <div class="berat" id="modal-berat"></div>
  <div class="harga" id="modal-harga"></div>
  <div class="deskripsi" id="modal-deskripsi"></div>
  <div class="stok">Stok: <span id="modal-stok"></span></div>
  <button>Masukkan Keranjang</button>
</div>

<script>
  function bukaModal(img, nama, harga, berat, deskripsi, stok) {
    document.getElementById('modal-img').src = img;
    document.getElementById('modal-nama').innerText = nama;
    document.getElementById('modal-harga').innerText = harga;
    document.getElementById('modal-berat').innerText = berat;
    document.getElementById('modal-deskripsi').innerText = deskripsi;
    document.getElementById('modal-stok').innerText = stok;

    document.getElementById('modal').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
  }

  function tutupModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
  }
</script>

</body>
</html>
