<?php
session_start();
include 'config.php';
include 'navbar.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include_once 'Sale.php';
include_once 'Product.php';

$sale = new Sale($db);
$product = new Product($db);

if ($_POST) {
    $sale->product_id = $_POST['product_id'];
    $sale->quantity = $_POST['quantity'];
    $sale->total = $_POST['total'];

    if ($sale->create()) {
        echo "<div class='alert alert-success'>Sale added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to add sale.</div>";
    }
}

$products = $product->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Add Sale</h1>
    <form action="add_sale.php" method="post">
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select class="form-control" id="product_id" name="product_id">
                <?php while ($row = $products->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Sale</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
