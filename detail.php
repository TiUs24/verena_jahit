<?php 
include 'config/db.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-4">← Kembali</a>
    
    <div class="card shadow-lg border-0">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="assets/<?= $data['gambar'] ?>" class="img-fluid rounded-start w-100 h-100 object-fit-cover">
            </div>
            <div class="col-md-7">
                <div class="card-body p-4">
                    <h3 class="card-title mb-1"><?= $data['nama_produk'] ?></h3>
                    <p class="text-muted mb-2">Kode: <?= $data['kode_baju'] ?></p>
                    <h4 class="text-primary mb-3">Rp <?= number_format($data['harga'], 0, ',', '.') ?></h4>

                    <?php if (!empty($data['ukuran'])): ?>
                        <p><strong>Ukuran:</strong> <?= $data['ukuran'] ?></p>
                    <?php endif; ?>

                    <hr>
                    <p class="card-text"><?= nl2br($data['deskripsi']) ?></p>
                    <a  href="https://wa.me/6285742961757?text=<?= urlencode('Halo kak saya minat baju dengan kode ' . $data['kode_baju']) ?>"   target="_blank" class="btn btn-success mt-3"> <i class="bi bi-whatsapp"></i> Pesan Sekarang</a>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
