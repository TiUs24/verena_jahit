<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Produk tidak ditemukan.");
}

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_baju = $_POST['kode_baju'];

    $nama = htmlspecialchars($_POST['nama']);
    $harga = $_POST['harga'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/" . $gambar);
        $update = mysqli_query($conn, "UPDATE produk SET kode_baju='$kode_baju', nama_produk='$nama', harga='$harga', deskripsi='$deskripsi', gambar='$gambar' WHERE id='$id'");
    } else {
        $update = mysqli_query($conn, "UPDATE produk SET kode_baju='$kode_baju', nama_produk='$nama', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'");

    }

    if ($update) {
        $success = true;
        $query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
        $data = mysqli_fetch_assoc($query); // ambil data terbaru
    } else {
        $error = "Gagal memperbarui produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .preview-img {
            width: 120px;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5 col-md-6">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-4">Edit Produk</h4>
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label class="form-label">Kode Baju</label>
                    <input type="text" name="kode_baju" class="form-control" value="<?= $data['kode_baju'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama_produk'] ?>" required>
                    <div class="invalid-feedback">Nama produk wajib diisi.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                    <div class="invalid-feedback">Harga tidak boleh kosong.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required><?= $data['deskripsi'] ?></textarea>
                    <div class="invalid-feedback">Deskripsi diperlukan.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="../assets/<?= $data['gambar'] ?>" class="preview-img" id="gambarLama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Gambar Baru (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" class="preview-img d-none">
                </div>
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<!-- Toast Notifikasi -->
<?php if ($success): ?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast show align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                ✅ Produk berhasil diperbarui!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Bootstrap form validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();

    // Gambar preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>
