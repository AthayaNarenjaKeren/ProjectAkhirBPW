<?php include './view/layout/header.php'; ?>

<h2>Daftar Buku di Toko</h2>

<!-- Filter Genre -->
<form method="GET">
    <input type="hidden" name="page" value="shop">
    <label>Filter Genre:</label>
    <select name="genre" onchange="this.form.submit()">
        <option value="">Semua Genre</option>
        <option value="Fiksi" <?= ($_GET['genre'] ?? '') == 'Fiksi' ? 'selected' : '' ?>>Fiksi</option>
        <option value="Non-Fiksi" <?= ($_GET['genre'] ?? '') == 'Non-Fiksi' ? 'selected' : '' ?>>Non-Fiksi</option>
        <option value="Anak-anak" <?= ($_GET['genre'] ?? '') == 'Anak-anak' ? 'selected' : '' ?>>Anak-anak</option>
       <option value="Pendidikan" <?= ($_GET['genre'] ?? '') == 'Pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
        <!-- Tambah genre sesuai kebutuhan -->
    </select>
</form>

<br>

<!-- Daftar Buku -->
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php while ($row = $data->fetch_assoc()): ?>
    <div style="width: 220px; border: 1px solid #ccc; padding: 10px;">
        <img src="public/images/<?= $row['gambar'] ?>" alt="<?= $row['judul'] ?>" style="width: 100%; height: 250px; object-fit: cover;"><br>
        <strong><?= $row['judul'] ?></strong><br>
        <small>Rp<?= number_format($row['harga'], 0, ',', '.') ?></small><br>
        <p><?= substr($row['deskripsi'], 0, 50) ?>...</p>
        <a href="index.php?page=keranjang&act=tambah&id=<?= $row['id'] ?>">🛒 Beli</a>
    </div>
<?php endwhile; ?>
</div>

<!-- Pagination -->
<div style="margin-top: 20px;">
    <?php for ($i = 1; $i <= $total_page; $i++): ?>
        <a href="index.php?page=shop&genre=<?= $genre ?>&p=<?= $i ?>" style="margin-right: 5px;"><?= $i ?></a>
    <?php endfor; ?>
</div>

<?php include './view/layout/footer.php'; ?>
