<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $quantity;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=?, quantity=?, price=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sid", $this->name, $this->quantity, $this->price);
        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $this->name = $row['name'];
        $this->quantity = $row['quantity'];
        $this->price = $row['price'];
    }

    public function updateQuantity() {
        $query = "UPDATE " . $this->table_name . " SET quantity=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->quantity, $this->id);
        return $stmt->execute();
    }
}
?>
