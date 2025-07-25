<?php
include './config/database.php';
include './model/Buku.php';

$buku = new Buku($conn);

$genre = $_GET['genre'] ?? null;
$data = $buku->semuaBuku($genre);

include './view/product.php';
?>
