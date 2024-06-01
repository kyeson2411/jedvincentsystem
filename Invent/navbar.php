<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Sales Inventory</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Products</a>
                </li>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_sales.php">View Sales</a>
                    </li>
                    
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_transactions.php">Your Transactions</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
