<?php
class Pesanan {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function hitungPesanan() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM riwayat");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function hitungPendapatan() {
        $result = $this->conn->query("SELECT SUM(total) AS total FROM riwayat");
        return $result->fetch_assoc()['total'] ?? 0;
    }
}
