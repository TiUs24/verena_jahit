<?php include '../config/db.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_baju = $_POST['kode_baju'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../assets/" . $gambar);

    mysqli_query($conn, "INSERT INTO produk (kode_baju, nama_produk, harga, deskripsi, gambar, ukuran)
                     VALUES ('$kode_baju', '$nama', '$harga', '$deskripsi', '$gambar', '$ukuran')");

    header("Location: ../admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Produk Baru</h4>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                     <label class="form-label">Kode Baju</label>
                     <input type="text" name="kode_baju" class="form-control" placeholder="Contoh: BJ001" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan Produk</button>
                <a href="../admin/index.php" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
