<?php
include './config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $cek = $stmt->get_result();

    if ($cek->num_rows > 0) {
        $error = "Email sudah digunakan!";
    } else {
        // Simpan data dengan prepared statement
        $stmt = $conn->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $nama, $email, $pass);
        $stmt->execute();

        echo "<script>alert('Pendaftaran berhasil, silakan login'); window.location='index.php?page=login';</script>";
        exit;
    }
}

include './view/register.php';
?>
