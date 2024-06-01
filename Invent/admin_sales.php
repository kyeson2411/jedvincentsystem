<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php 
    session_start();
    include 'navbar.php'; 
    include 'config.php';
    include_once 'Sale.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Create Sale object
    $sale = new Sale($db);

    // Fetch all sales for admin view with product names
    $query = "SELECT sales.*, products.name AS item_name FROM sales INNER JOIN products ON sales.product_id = products.id";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error: " . $db->error);
    }

    // Calculate total profit
    $total_profit = 0;
?>
<div class="container mt-5">
    <h1 class="mb-4">View Sales</h1>
    <div class="mb-3">
        <h4>Total Profit: $<?php echo number_format($total_profit, 2); ?></h4>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Product ID</th>
                <th>Item Name</th>
                <th>User ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()): 
                    $total_profit += $row['total_price'];
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td> <!-- Updated to 'item_name' -->
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php 
                endwhile; 
            } else {
                echo "<tr><td colspan='7'>No sales found.</td></tr>";
            }

            // Free result set
            $result->free_result();

            // Close connection
            $db->close();
            ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
