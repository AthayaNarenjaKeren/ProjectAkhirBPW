<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            return $user;
        }

        return false;
    }
    public function hitungUser() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM users WHERE role='user'");
    return $stmt->fetch_assoc()['total'];
}
public function getAllUsers() {
    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = $this->conn->query($query);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}

public function hapusUser($id) {
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


}
?>
