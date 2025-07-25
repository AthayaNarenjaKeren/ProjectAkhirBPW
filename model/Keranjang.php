<?php
class Keranjang {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function tambah($user_id, $buku_id, $jumlah) {
        // Cek apakah item sudah ada
        $cek = $this->conn->query("SELECT * FROM keranjang WHERE user_id=$user_id AND buku_id=$buku_id");
        if ($cek->num_rows > 0) {
            return $this->conn->query("UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE user_id=$user_id AND buku_id=$buku_id");
        } else {
            return $this->conn->query("INSERT INTO keranjang (user_id, buku_id, jumlah) VALUES ($user_id, $buku_id, $jumlah)");
        }
    }

   public function getKeranjang($user_id) {
    return $this->conn->query("SELECT k.*, b.judul, b.harga, b.id AS buku_id
                               FROM keranjang k
                               JOIN buku b ON k.buku_id = b.id
                               WHERE k.user_id = $user_id");
}


    public function hapus($id) {
        return $this->conn->query("DELETE FROM keranjang WHERE id=$id");
    }

    public function kosongkan($user_id) {
        return $this->conn->query("DELETE FROM keranjang WHERE user_id=$user_id");
    }
}
?>
