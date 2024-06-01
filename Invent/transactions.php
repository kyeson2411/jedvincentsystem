<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT s.id, p.name AS product_name, s.quantity, s.total_price, s.date 
          FROM sales s 
          JOIN products p ON s.product_id = p.id 
          WHERE s.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Transactions</title>
</head>
<body>
    <h1>Your Transactions</h1>
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td>
                    <form action="refund.php" method="POST">
                        <input type="hidden" name="sale_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="refund">Request Refund</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
