<?php
include './config/database.php';

$user_id = $_SESSION['user']['id'] ?? null;
if (!$user_id) {
    header("Location: index.php?page=login");
    exit;
}

$data = $conn->query("SELECT r.*, b.judul FROM riwayat r JOIN buku b ON r.buku_id = b.id WHERE r.user_id=$user_id ORDER BY r.tanggal DESC");

include './view/layout/header.php';
?>

<h2>Riwayat Pembelian</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Buku</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Metode</th>
        <th>Tanggal</th>
    </tr>
    <?php while($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= $row['metode'] ?></td>
            <td><?= $row['tanggal'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include './view/layout/footer.php'; ?>
