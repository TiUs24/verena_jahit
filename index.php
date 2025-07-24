<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verena Jahit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .katalog-title {
            font-size: 2.5rem;
            background: linear-gradient(to right, #e91e63, #ff80ab);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        body {
            background: linear-gradient(135deg, #fff5f8, #fefefe);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #e91e63;
        }
        .navbar-brand {
            font-weight: bold;
            color: white;
        }
        .navbar-brand:hover {
            color: #ffe6ec;
        }
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            border: none;
            border-radius: 16px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        .card img {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            object-fit: cover;
            height: 220px;
        }
        footer {
            background-color: #212529;
            color: white;
            padding: 30px 0;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="info.php">🧵 Verena Jahit</a>
    </div>
</nav>

<!-- FILTER SORTING -->
<div class="container mt-5">
<h1 class="text-center fw-bold mb-4 katalog-title">
    ✨ Katalog Butik <span class="text-pink">Verena Jahit</span> ✨
</h1>

    <form method="GET" class="row g-3 mb-4 justify-content-end">
        <div class="col-md-3">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">Urutkan Harga</option>
                <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : '' ?>>Termurah</option>
                <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>Termahal</option>
            </select>
        </div>
    </form>

    <!-- KATALOG PRODUK -->
    <div class="row">
        <?php
        $order = "";
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if ($sort == 'asc') $order = "ORDER BY harga ASC";
            else if ($sort == 'desc') $order = "ORDER BY harga DESC";
        }

        $query = mysqli_query($conn, "SELECT * FROM produk $order");
        if (mysqli_num_rows($query) === 0) {
            echo "<div class='col text-center'><p class='text-muted'>Tidak ada produk ditemukan.</p></div>";
        }

        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="assets/<?= $data['gambar'] ?>" class="card-img-top">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $data['nama_produk'] ?></h5>
                    <small class="text-muted mb-2">Kode: <?= $data['kode_baju'] ?></small>
                    <p class="card-text text-primary fw-semibold">Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
                    <a href="detail.php?id=<?= $data['id'] ?>" class="btn btn-outline-danger mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-center mt-5">
    <div class="container">
        <p class="mb-2">Untuk pemesanan custom, hubungi kami via WhatsApp</p>
        <a href="https://wa.me/6285742961757?text=Halo%20Verena%20Jahit%2C%20saya%20tertarik%20dengan%20produk%20Anda" target="_blank" class="btn btn-success">
            <i class="bi bi-whatsapp"></i> 0857-4296-1757
        </a>
    </div>
</footer>

</body>
</html>
