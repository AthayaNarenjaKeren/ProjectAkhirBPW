<?php include './view/layout/header.php'; ?>

<h2>Daftar Buku</h2>

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

<div class="buku-list">
  <?php while($row = $data->fetch_assoc()): ?>
    <div class="buku-item">
      <img src="public/images/<?= $row['gambar'] ?>" width="150">
      <h4><?= $row['judul'] ?></h4>
      <p><?= substr($row['deskripsi'], 0, 100) ?>...</p>
      <p>Harga: Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
      <a href="index.php?page=shop&id=<?= $row['id'] ?>">Beli Sekarang</a>
      <a href="index.php?page=wishlist&act=tambah&id=<?= $row['id'] ?>">❤️ Favorit</a>
    </div>
  <?php endwhile; ?>
</div>


<?php include './view/layout/footer.php'; ?>
