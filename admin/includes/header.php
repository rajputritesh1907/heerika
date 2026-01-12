<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Heerika</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>
<body>

    <div class="admin-sidebar">
        <div class="admin-logo">
            <a href="index.php">HEERIKA ADMIN</a>
        </div>
        <nav class="admin-nav">
            <ul>
                <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <a href="index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'products.php' || basename($_SERVER['PHP_SELF']) == 'add_product.php' ? 'active' : ''; ?>">
                    <a href="products.php"><i class="fa-solid fa-gem"></i> Products</a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-list"></i> Categories</a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-users"></i> Users</a>
                </li>
                <li>
                    <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Site</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="admin-main">
