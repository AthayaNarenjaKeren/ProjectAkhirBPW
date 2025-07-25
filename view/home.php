<?php include './view/layout/header.php'; ?>

<h2>Buku Terpopuler</h2>
<<div class="buku-list">
  <<?php while($row = $result->fetch_assoc()): ?>
    <div class="buku-item">
        <img src="public/images/<?= $row['gambar'] ?>" width="150">
        <h3><?= $row['judul']; ?></h3>
        <p>Rating: <?= $row['rating']; ?></p>
    </div>
<?php endwhile; ?>
</div>

<?php include './view/layout/footer.php'; ?>

