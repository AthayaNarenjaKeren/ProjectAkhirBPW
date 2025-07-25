<?php
include './config/database.php';
include './model/Buku.php';
include './model/User.php';
include './model/Pesanan.php';

$bukuModel = new Buku($conn);
$userModel = new User($conn);
$pesananModel = new Pesanan($conn);

$total_buku = $bukuModel->hitungBuku();
$total_user = $userModel->hitungUser();
$total_pesanan = $pesananModel->hitungPesanan();
$total_pendapatan = $pesananModel->hitungPendapatan();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="public/css/admin.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="public/images/Waifuku.jpeg" alt="Admin Avatar" class="avatar">
            <h2>Admin Panel</h2>
            <a href="index.php?page=admin&action=crud" class="btn">📚 Kelola Buku</a>
            <a href="index.php?page=admin&action=user" class="btn">👥 Kelola User</a>
        </div>

        <div class="main">
            <h1>Selamat datang, Admin</h1>
            <div class="card-container">
                <div class="card">
                    <h3>Total Buku</h3>
                    <p><?= $total_buku ?></p>
                </div>
                <div class="card">
                    <h3>Total User</h3>
                    <p><?= $total_user ?></p>
                </div>
                <div class="card">
                    <h3>Total Pesanan</h3>
                    <p><?= $total_pesanan ?></p>
                </div>
                <div class="card">
                    <h3>Total Pendapatan</h3>
                    <p>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</div>
