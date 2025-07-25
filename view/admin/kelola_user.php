<?php
include './config/database.php';
include './model/User.php';

$userModel = new User($conn);

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $userModel->hapusUser($id);
    header("Location: index.php?page=admin&action=user");
    exit;
}

$users = $userModel->getAllUsers();
?>

<!-- Layout Admin -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola User - Admin</title>
    <link rel="stylesheet" href="assets/css/admin-style.css"> <!-- kalau ada -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #333;
            float: left;
            color: white;
            padding: 20px;
        }

        .sidebar h3 {
            color: #fff;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        a.hapus-link {
            color: red;
            text-decoration: none;
        }

        a.hapus-link:hover {
            text-decoration: underline;
        }

        .gray-text {
            color: gray;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Admin Panel</h3>
    <a href="index.php?page=admin&action=dashboard">Dashboard</a>
    <a href="index.php?page=admin&action=crud">Kelola Buku</a>
    <a href="index.php?page=admin&action=user">Kelola User</a>
    <a href="index.php?page=logout">Logout</a>
</div>

<div class="content">
    <h2>Kelola User</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($users as $user): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($user['nama']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td><?= htmlspecialchars($user['role']); ?></td>
                    <td>
                        <?php if ($user['role'] !== 'admin'): ?>
                            <a href="index.php?page=admin&action=user&hapus=<?= $user['id']; ?>" class="hapus-link" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                        <?php else: ?>
                            <span class="gray-text">Tidak bisa dihapus</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
