<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['refund'])) {
    $sale_id = $_POST['sale_id'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM sales WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $sale_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $query = "DELETE FROM sales WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $sale_id);

        if ($stmt->execute()) {
            echo "Refund processed successfully.";
        } else {
            echo "Error processing refund: " . $stmt->error;
        }
    } else {
        echo "Invalid sale ID.";
    }
} else {
    echo "Invalid request.";
}
?>
