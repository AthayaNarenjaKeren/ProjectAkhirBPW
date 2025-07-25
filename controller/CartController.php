<?php
include './config/database.php';
include './model/Buku.php';
include './model/Keranjang.php';

$buku = new Buku($conn);
$cart = new Keranjang($conn);

$user_id = $_SESSION['user']['id'] ?? null;

if (!$user_id) {
    header("Location: index.php?page=login");
    exit;
}

// Tambah ke keranjang
if (isset($_GET['id'])) {
    $buku_id = $_GET['id'];
    $cart->tambah($user_id, $buku_id, 1);
    header("Location: index.php?page=keranjang");
    exit;
}
?>
