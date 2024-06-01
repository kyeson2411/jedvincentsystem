<?php
session_start();
include 'config.php';
include_once 'User.php'; // Include the User class for user-related operations
include_once 'Sale.php'; // Include the Sale class for sale-related operations

// Debug: Output session variables
echo "Debug: Session user ID: " . $_SESSION['user_id'] . ", Session user role: " . $_SESSION['user_role'] . "<br>";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Debug: Output session variables again
echo "Debug: Passed authorization check<br>";

// Create User and Sale objects
$user = new User($db);
$sale = new Sale($db);

// Get all users
$users = $user->getAllUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View All Users and Total Purchases</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'admin_navbar.php'; ?> <!-- Include the admin navbar -->
<div class="container mt-5">
    <h1 class="mb-4">All Users and Total Purchases</h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Purchases</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <?php
                        // Get total purchases for this user
                        $total_purchases = $sale->getTotalPurchasesByUser($user['id']);
                        echo htmlspecialchars($total_purchases);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
