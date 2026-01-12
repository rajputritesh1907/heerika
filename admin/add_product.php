<?php
require_once '../config/db.php';
include 'includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $sale_price = !empty($_POST['sale_price']) ? $_POST['sale_price'] : NULL;
    $description = $_POST['description'];
    
    // Simple slug generation
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    
    // Image Upload (Simple handling)
    $image_path = 'assets/images/placeholder.png'; // Default
    if (isset($_POST['image_url']) && !empty($_POST['image_url'])) {
        $image_path = $_POST['image_url'];
    }

    // Insert
    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, slug, category_id, price, sale_price, description, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $slug, $category_id, $price, $sale_price, $description, $image_path]);
        $success = "Product added successfully!";
    } catch (PDOException $e) {
        $error = "Error adding product: " . $e->getMessage();
    }
}

// Fetch Categories for Dropdown
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-header">
    <h1 class="page-title">Add New Product</h1>
    <a href="products.php" class="btn-sm btn-primary">Back to List</a>
</div>

<?php if($success): ?>
    <div style="background:#d4edda; color:#155724; padding:15px; border-radius:4px; margin-bottom:20px;"><?php echo $success; ?></div>
<?php endif; ?>

<?php if($error): ?>
    <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:4px; margin-bottom:20px;"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="POST">
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Image URL (Relative to root)</label>
                <input type="text" name="image_url" class="form-control" placeholder="assets/images/cat_rings.png" value="assets/images/cat_rings.png">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Regular Price (₹)</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Sale Price (₹) (Optional)</label>
                <input type="number" name="sale_price" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>

        <button type="submit" class="btn-sm btn-primary" style="padding: 12px 30px; font-size: 1rem;">Save Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
