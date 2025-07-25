<?php include './view/layout/header.php'; ?>
<h2 style="text-align:center; margin-top: 30px;">Daftar Favorit</h2>

<?php if ($data->num_rows > 0): ?>
    <div style="max-width: 700px; margin: 30px auto; padding: 10px;">
        <table border="1" cellspacing="0" cellpadding="10" width="100%" style="border-collapse: collapse; text-align: left;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><a href="index.php?page=wishlist&act=hapus&id=<?= $row['id'] ?>" style="color: red;" onclick="return confirm('Hapus dari favorit?')">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p style="text-align: center; margin-top: 50px;">Belum ada buku favorit.</p>
<?php endif; ?>

<?php include './view/layout/footer.php'; ?>
