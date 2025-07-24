<?php
session_start();
include '../config/db.php';
include 'header.php';

$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<h3>Data Produk</h3>
<a href="tambah.php" class="btn btn-success mb-3">+ Tambah Produk</a>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode Baju</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; while($row = mysqli_fetch_assoc($produk)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['kode_baju'] ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td>Rp<?= number_format($row['harga'],0,",",".") ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td><img src="../assets/<?= $row['gambar'] ?>" width="60"></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
