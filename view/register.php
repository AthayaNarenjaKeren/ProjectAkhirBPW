<?php include './view/layout/header.php'; ?>
<div class="form-container">
    <h2>Daftar Akun Baru</h2>
    <form method="post">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required="Masukkan nama">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required="Masukkan email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required="Masukkan password">
        </div>
        <div class="form-group">
            <button type="submit">Daftar</button>
        </div>
    </form>
</div>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php include './view/layout/footer.php'; ?>

