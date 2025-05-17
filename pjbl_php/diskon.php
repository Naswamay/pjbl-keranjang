<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Diskon</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom right, #b3ecff, #a6e1fa);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .promo-container {
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 40px;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
      border-radius: 4px;
      max-width: 900px;
      width: 90%;
      flex-wrap: wrap;
    }

    .promo-text {
      max-width: 400px;
    }

    .promo-text h1 {
      font-size: 36px;
      margin: 0;
      font-weight: 900;
    }

    .promo-text p {
      font-size: 20px;
      margin: 10px 0 20px 0;
      font-weight: bold;
    }

    .promo-button {
      background-color: #4d6a77;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 20px;
      cursor: pointer;
    }

    .promo-button:hover {
      background-color: #395563;
    }

    .promo-image img {
      width: 300px;
      max-width: 100%;
      height: auto;
    }

    @media (max-width: 768px) {
      .promo-container {
        flex-direction: column;
        text-align: center;
      }

      .promo-text {
        max-width: 100%;
      }

      .promo-image img {
        margin-top: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="promo-container">
    <div class="promo-text">
      <h1>DISKON 20%</h1>
      <p>untuk pengguna baru</p>
      <button class="promo-button">Dapatkan Diskon</button>
    </div>
    <div class="promo-image">
      <img src="diskon-produk.png" alt="Produk Diskon">
    </div>
  </div>

</body>
</html>
