<?php
include './config/database.php';
include './model/Buku.php';

$buku = new Buku($conn);

// Aksi CRUD
if (isset($_POST['tambah'])) {
    // Tangani upload gambar
    $nama_file = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    if ($nama_file != '') {
        move_uploaded_file($tmp, "./public/images/" . $nama_file);
    }

    $_POST['gambar'] = $nama_file;
    $buku->tambah($_POST);
    header("Location: index.php?page=admin&action=crud");
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    // Cek jika upload gambar baru
    if ($_FILES['gambar']['name'] != '') {
        $nama_file = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "./public/images/" . $nama_file);
        $_POST['gambar'] = $nama_file;
    } else {
        $_POST['gambar'] = $_POST['gambar_lama'];
    }

    $buku->update($id, $_POST);
    header("Location: index.php?page=admin&action=crud");
    exit;
}

if (isset($_GET['hapus'])) {
    $buku->hapus($_GET['hapus']);
    header("Location: index.php?page=admin&action=crud");
    exit;
}

$data = $buku->semuaBuku();
include './view/layout/header.php';
?>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: #f5f5f5;
    }

    .admin-container {
        max-width: 95%;
        margin: 20px auto;
    }

    h2, h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background: #007bff;
        color: white;
    }

    form.inline-form input[type="text"],
    form.inline-form input[type="number"],
    form.inline-form input[type="file"] {
        width: 95%;
        padding: 5px;
        box-sizing: border-box;
    }

    form.inline-form img {
        display: block;
        margin: 5px auto;
        max-height: 100px;
    }

    .form-tambah {
        width: 60%;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .form-tambah input,
    .form-tambah textarea {
        width: 100%;
        padding: 10px;
        margin: 6px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    button {
        background: #28a745;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 5px;
    }

    button:hover {
        background: #218838;
    }

    a {
        text-decoration: none;
        color: red;
    }
 <style>
    .table-wrapper {
        overflow-x: auto;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
    }

    table th,
    table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }

    table th {
        background-color: #007bff;
        color: white;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }

    .btn-update {
        padding: 6px 12px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-delete {
        color: red;
        display: block;
        margin-top: 5px;
        text-decoration: none;
    }

    img.preview {
        max-height: 60px;
        margin-bottom: 5px;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
    }
</style>

<h2>Kelola Buku</h2>
<a href="index.php?page=admin&action=dashboard">Kembali ke Dashboard</a>
<div class="table-wrapper">
    <table>
        <tr>
            <th>Judul</th>
            <th>Genre</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Rating</th>
            <th>Gambar</th>
            <th>Opsi</th>
        </tr>
        <?php while($row = $data->fetch_assoc()): ?>
        <tr>
            <form class="inline-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                <td><input type="text" name="judul" value="<?= $row['judul'] ?>"></td>
                <td><input type="text" name="genre" value="<?= $row['genre'] ?>"></td>
                <td><input type="number" name="harga" value="<?= $row['harga'] ?>"></td>
                <td><input type="number" name="stok" value="<?= $row['stok'] ?>"></td>
                <td><input type="number" step="0.1" name="rating" value="<?= $row['rating'] ?>"></td>
                <td>
                    <img src="public/images/<?= $row['gambar'] ?>" width="60">
                    <input type="file" name="gambar">
                </td>
                <td>
                    <button type="submit" name="update">Update</button><br><br>
                    <a href="index.php?page=admin&action=crud&hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Tambah Buku Baru</h3>
    <form method="post" enctype="multipart/form-data" class="form-tambah">
        <input type="text" name="judul" placeholder="Judul" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="number" step="0.1" name="rating" placeholder="Rating" required>
        <textarea name="deskripsi" placeholder="Deskripsi Buku"></textarea>
        <label>Upload Gambar:</label>
        <input type="file" name="gambar" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>
</div>


<?php include './view/layout/footer.php'; ?>
