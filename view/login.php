<?php include './view/layout/header.php'; ?>

<div class="form-container">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    

    <form action="index.php?page=login" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Masukkan email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password">
        </div>

        <button type="submit">Login</button>
    </form>
</div>
<?php include './view/layout/footer.php'; ?>
