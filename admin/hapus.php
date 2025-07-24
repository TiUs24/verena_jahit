<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT gambar FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $gambar_path = "../assets/" . $data['gambar'];
    if (file_exists($gambar_path)) {
        unlink($gambar_path); // hapus gambar dari folder
    }

    mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
}

header("Location: index.php");
