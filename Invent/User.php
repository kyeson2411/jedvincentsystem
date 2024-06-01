<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET username=?, password=?, role=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->username, $this->password, $this->role);
        return $stmt->execute();
    }
}
?>
