<?php
include './config/database.php';
include './model/Buku.php';

$buku = new Buku($conn);

$genre = $_GET['genre'] ?? null;
$page = $_GET['p'] ?? 1;
$limit = 6;
$start = ($page - 1) * $limit;

$data = $buku->semuaBukuPaging($genre, $start, $limit);
$total_data = $buku->hitungTotal($genre);
$total_page = ceil($total_data / $limit);

include './view/shop.php';
?>