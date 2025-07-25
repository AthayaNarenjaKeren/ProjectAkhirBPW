<?php
session_start();
$page = $_GET['page'] ?? 'home';

switch($page) {
    case 'home':
    include './controller/HomeController.php';
    break;

    case 'product': include './controller/BukuController.php'; break;
    case 'shop': include './controller/ShopController.php'; break;
    case 'about': include './view/about.php'; break;
    case 'contact': include './view/contact.php'; break;
    case 'login': include './controller/AuthController.php'; break;
    case 'logout': session_destroy(); header('Location: index.php'); break;
    case 'keranjang': 
    include './controller/CartController.php'; // Pindahkan ini ke atas
    include './view/keranjang.php'; 
    break;

    

    case 'admin':
    $action = $_GET['action'] ?? 'dashboard';

    switch ($action) {
        case 'dashboard':
            include './view/admin/dashboard.php';
            break;
        case 'crud':
            include './view/admin/crud_buku.php';
            break;
        case 'user':
            include './view/admin/kelola_user.php';
            break;
        default:
            include './view/admin/dashboard.php';
            break;
    }
    break;

    
    case 'register': include './controller/RegisterController.php'; break;
    case 'riwayat': include './view/riwayat.php'; break;
    case 'wishlist': include './controller/WishlistController.php'; break;
    case 'profile': include './view/profile.php'; break;
    
    default: include './controller/HomeController.php'; break;
}
?>
