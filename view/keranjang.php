<?php
include './config/database.php';
require_once './model/Keranjang.php';


$user_id = $_SESSION['user']['id'] ?? null;
if (!$user_id) {
    header("Location: index.php?page=login");
    exit;
}

$cart = new Keranjang($conn);
$data = $cart->getKeranjang($user_id);
$total = 0;
?>

<?php include './view/layout/header.php'; ?>

<h2>Keranjang Belanja</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Buku</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total</th>
    </tr>
    <?php while($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>Rp<?= number_format($row['harga'] * $row['jumlah'], 0, ',', '.') ?></td>
        </tr>
        <?php $total += $row['harga'] * $row['jumlah']; ?>
    <?php endwhile; ?>
</table>

<h3>Total Bayar: Rp<?= number_format($total, 0, ',', '.') ?></h3>

<form method="post" action="">
    <label>Pilih Metode Pembayaran:</label><br>
    <select name="metode">
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="COD">COD</option>
        <option value="E-wallet">E-Wallet</option>
    </select><br><br>
    <button type="submit" name="bayar">Bayar Sekarang</button>
</form>

<?php
if (isset($_POST['bayar'])) {
    $metode = $_POST['metode'];
    $items = $cart->getKeranjang($user_id);

    while ($row = $items->fetch_assoc()) {
        $buku_id = $row['buku_id'];
        $jumlah  = $row['jumlah'];
        $total   = $row['harga'] * $jumlah;

        $conn->query("INSERT INTO riwayat (user_id, buku_id, jumlah, total, metode)
                      VALUES ($user_id, $buku_id, $jumlah, $total, '$metode')");
    }

    $cart->kosongkan($user_id);
    echo "<script>alert('Pembayaran berhasil!'); window.location='index.php?page=riwayat';</script>";
}

?>

<?php include './view/layout/footer.php'; ?>
