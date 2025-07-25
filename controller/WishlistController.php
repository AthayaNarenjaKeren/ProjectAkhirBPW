<?php
include './config/database.php';

$user_id = $_SESSION['user']['id'] ?? null;
if (!$user_id) header("Location: index.php?page=login");

if (isset($_GET['act']) && $_GET['act'] == 'tambah') {
    $buku_id = $_GET['id'];
    $cek = $conn->query("SELECT * FROM wishlist WHERE user_id=$user_id AND buku_id=$buku_id");
    if ($cek->num_rows == 0) {
        $conn->query("INSERT INTO wishlist (user_id, buku_id) VALUES ($user_id, $buku_id)");
    }
    header("Location: index.php?page=wishlist");
} elseif (isset($_GET['act']) && $_GET['act'] == 'hapus') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM wishlist WHERE id=$id");
    header("Location: index.php?page=wishlist");
} else {
    $data = $conn->query("SELECT w.*, b.judul FROM wishlist w JOIN buku b ON w.buku_id = b.id WHERE w.user_id = $user_id");
    include './view/wishlist.php';
}
