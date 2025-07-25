<?php
class Buku {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function semuaBuku($genre = null) {
        $sql = "SELECT * FROM buku";
        if ($genre) {
            $sql .= " WHERE genre = '$genre'";
        }
        return $this->conn->query($sql);
    }

    public function populer($limit = 4) {
    $stmt = $this->conn->prepare("SELECT * FROM buku ORDER BY rating DESC LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    public function byId($id) {
        return $this->conn->query("SELECT * FROM buku WHERE id=$id")->fetch_assoc();
    }

    public function tambah($data) {
        extract($data);
        return $this->conn->query("INSERT INTO buku (judul, genre, harga, stok, deskripsi, rating, gambar)
            VALUES ('$judul', '$genre', $harga, $stok, '$deskripsi', $rating, '$gambar')");
    }

    public function update($id, $data) {
        extract($data);
        return $this->conn->query("UPDATE buku SET judul='$judul', genre='$genre', harga=$harga,
            stok=$stok, deskripsi='$deskripsi', rating=$rating, gambar='$gambar' WHERE id=$id");
    }

    public function hapus($id) {
        return $this->conn->query("DELETE FROM buku WHERE id=$id");
    }
    public function semuaBukuPaging($genre = null, $start = 0, $limit = 6)
{
    if ($genre) {
        $stmt = $this->conn->prepare("SELECT * FROM buku WHERE genre = ? LIMIT ?, ?");
        $stmt->bind_param("sii", $genre, $start, $limit);
    } else {
        $stmt = $this->conn->prepare("SELECT * FROM buku LIMIT ?, ?");
        $stmt->bind_param("ii", $start, $limit);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

public function hitungTotal($genre = null)
{
    if ($genre) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM buku WHERE genre = ?");
        $stmt->bind_param("s", $genre);
    } else {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM buku");
    }

    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['total'];
}
public function hitungBuku() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM buku");
    return $stmt->fetch_assoc()['total'];
}

}
?>
