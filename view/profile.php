<?php
include './config/database.php';

$user = $_SESSION['user'];

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $id = $user['id'];

    $conn->query("UPDATE users SET nama='$nama', email='$email', password='$pass' WHERE id=$id");

    $_SESSION['user']['nama'] = $nama;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['password'] = $pass;

    echo "<script>alert('Profil berhasil diperbarui');</script>";
}
?>

<?php include './view/layout/header.php'; ?>

<h2>Profil Saya</h2>
<form method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $user['nama'] ?>"><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
    <label>Password:</label><br>
    <input type="text" name="password" value="<?= $user['password'] ?>"><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

<?php include './view/layout/footer.php'; ?>
