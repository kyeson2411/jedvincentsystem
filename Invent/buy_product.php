<?php
session_start();
include 'config.php';
include_once 'Sale.php';
include_once 'Product.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$product = new Product($db);
$sale = new Sale($db);

if ($_POST) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $user_id = (int)$_SESSION['user_id'];

    // Fetch product details
    $product->id = $product_id;
    $product->readOne();

    if ($quantity > 0 && $quantity <= $product->quantity) {
        $total_price = $product->price * $quantity;

        // Create a new sale
        $sale->product_id = $product_id;
        $sale->user_id = $user_id;
        $sale->quantity = $quantity;
        $sale->total_price = $total_price;
        $sale->date = date('Y-m-d H:i:s');

        if ($sale->create()) {
            // Update product quantity
            $product->quantity -= $quantity;
            $product->updateQuantity();
            echo "<div class='alert alert-success'>Purchase successful.</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to process your purchase. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid quantity or insufficient stock.</div>";
    }
}
?>
