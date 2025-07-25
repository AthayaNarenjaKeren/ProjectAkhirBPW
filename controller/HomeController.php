<?php
include './config/database.php';
include './model/Buku.php';

$buku = new Buku($conn);
$data = $buku->populer();

$sql = "SELECT * FROM buku ORDER BY rating DESC LIMIT 5";
$result = $conn->query($sql); // $result = objek mysqli_result

include './view/home.php';
?>
