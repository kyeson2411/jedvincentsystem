<?php
class Sale {
    private $conn;
    private $table_name = "sales";

    public $id;
    public $product_id;
    public $user_id;
    public $quantity;
    public $total_price;
    public $date;
    public $status; // Added status property

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (product_id, user_id, quantity, total_price, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiids", $this->product_id, $this->user_id, $this->quantity, $this->total_price, $this->date);
        return $stmt->execute();
    }

    public function readByUser($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function cancelSale($sale_id, $user_id) {
        // Implement cancellation logic here
        $query = "UPDATE " . $this->table_name . " SET status = 'cancelled' WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $sale_id, $user_id);
        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function delete($sale_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $sale_id);
        return $stmt->execute();
    }
}
?>
