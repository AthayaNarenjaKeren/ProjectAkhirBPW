<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko Buku Online</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <div class="header-content">
        <h1>Toko Buku</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php?page=product">Produk</a>
            <a href="index.php?page=shop">Shop</a>
            <a href="index.php?page=about">Tentang Kami</a>
            <a href="index.php?page=contact">Kontak</a>

            <?php if (!empty($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                    <a href="index.php?page=admin&action=dashboard">Dashboard Admin</a>
                    <a href="index.php?page=logout">Logout</a>
                <?php else: ?>
                    <a href="index.php?page=keranjang">Keranjang</a>
                    <a href="index.php?page=riwayat">Riwayat</a>
                    <a href="index.php?page=profile">Profil</a>
                    <a href="index.php?page=logout">Logout</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="index.php?page=login">Login</a>
                <a href="index.php?page=register">Daftar</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
