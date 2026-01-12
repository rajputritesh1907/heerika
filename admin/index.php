<?php
require_once '../config/db.php';
include 'includes/header.php';

// Get counts
$product_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$order_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
?>

<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-gem"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $product_count; ?></h3>
            <p>Total Products</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $order_count; ?></h3>
            <p>Total Orders</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $user_count; ?></h3>
            <p>Total Users</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-indian-rupee-sign"></i>
        </div>
        <div class="stat-info">
            <h3>₹0</h3>
            <p>Total Revenue</p>
        </div>
    </div>
</div>

<div class="dashboard-widgets">
    <div class="widget-box">
        <h3 style="margin-bottom: 20px;">Recent Products</h3>
        
        <?php
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 5");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $p): ?>
                <tr>
                    <td><img src="../<?php echo htmlspecialchars($p['image']); ?>" width="40" style="border-radius:4px;"></td>
                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                    <td>₹<?php echo number_format($p['price']); ?></td>
                    <td>In Stock</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
