<?php
session_start();
include 'config.php';
include_once 'Product.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Instantiate product object
$product = new Product($db);

// Fetch all products
$result = $product->readAll();
if (!$result) {
    die("Error fetching products: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Inventory Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Products</h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'user'): ?>
                    <th>Buy</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'user'): ?>
                        <td>
                            <form action="buy_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <input type="number" name="quantity" value="1" min="1" max="<?php echo $row['quantity']; ?>">
                                <button type="submit" class="btn btn-primary">Buy</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
