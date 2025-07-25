<?php
include './config/database.php';
include './model/User.php';

$userModel = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $user = $userModel->login($email, $pass);
    if ($user) {
        $_SESSION['user'] = $user;
        if ($user['role'] === 'admin') {
            header('Location: index.php?page=admin');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}

include './view/login.php';
?>
