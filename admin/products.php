<?php
require_once '../config/db.php';
include 'includes/header.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='products.php';</script>";
}

// Fetch Products
$stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-header">
    <h1 class="page-title">Products</h1>
    <div>
        <a href="product_export.php" class="btn-sm btn-success" style="padding: 10px 20px; font-size: 1rem; margin-right: 10px;"><i class="fa-solid fa-file-csv"></i> Export CSV</a>
        <a href="product_import.php" class="btn-sm btn-primary" style="padding: 10px 20px; font-size: 1rem; margin-right: 10px; background-color: #17a2b8;"><i class="fa-solid fa-file-import"></i> Import CSV</a>
        <a href="add_product.php" class="btn-sm btn-primary" style="padding: 10px 20px; font-size: 1rem;"><i class="fa-solid fa-plus"></i> Add New Product</a>
    </div>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Featured</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td>#<?php echo $p['id']; ?></td>
            <td><img src="../<?php echo htmlspecialchars($p['image']); ?>" width="50" height="50" style="object-fit:cover; border-radius:4px;"></td>
            <td><?php echo htmlspecialchars($p['name']); ?></td>
            <td><?php echo htmlspecialchars($p['category_name']); ?></td>
            <td>₹<?php echo number_format($p['price']); ?></td>
            <td>
                <?php if($p['is_bestseller']) echo '<span style="background:#432858; color:white; padding:2px 6px; border-radius:4px; font-size:0.7rem;">Bestseller</span>'; ?>
                <?php if($p['is_new']) echo '<span style="background:#d11e64; color:white; padding:2px 6px; border-radius:4px; font-size:0.7rem;">New</span>'; ?>
            </td>
            <td>
                <a href="#" class="btn-sm btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                <a href="products.php?delete=<?php echo $p['id']; ?>" class="btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-regular fa-trash-can"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>
