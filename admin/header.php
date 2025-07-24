<?php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .wrapper {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="wrapper">
    <div class="sidebar">
        <h5 class="text-center">Halo, <?= $_SESSION['admin'] ?></h5>
        <a href="index.php">Dashboard</a>
        <a href="tambah.php">Tambah Produk</a>
    </div>
    <div class="content">
