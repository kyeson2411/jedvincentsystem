<?php
session_start();
include 'config.php';
include 'navbar.php';
include_once 'Sale.php';
include_once 'Product.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$sale = new Sale($db);
$product = new Product($db);

$sales = $sale->readAll();
$total_profit = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Sales Overview</h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>User ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $sales->fetch_assoc()): ?>
                <?php $product->id = $row['product_id']; $product->readOne(); ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
                <?php $total_profit += $row['total_price']; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="alert alert-info">
        <strong>Total Profit:</strong> <?php echo $total_profit; ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
