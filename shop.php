<?php
require_once 'config/db.php';
include 'includes/header.php';

// Get current category from URL
$current_category_slug = isset($_GET['category']) ? $_GET['category'] : null;
$search_query = isset($_GET['search']) ? $_GET['search'] : null;

// Build Query
$sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE 1=1";
$params = [];

if ($current_category_slug) {
    $sql .= " AND c.slug = :slug";
    $params[':slug'] = $current_category_slug;
}

if ($search_query) {
    $sql .= " AND (p.name LIKE :search OR p.description LIKE :search)";
    $params[':search'] = "%$search_query%";
}

// Sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
switch($sort) {
    case 'price_low': $sql .= " ORDER BY COALESCE(p.sale_price, p.price) ASC"; break;
    case 'price_high': $sql .= " ORDER BY COALESCE(p.sale_price, p.price) DESC"; break;
    default: $sql .= " ORDER BY p.created_at DESC"; // newest
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Categories for Sidebar with Count
$cat_stmt = $pdo->query("SELECT c.*, COUNT(p.id) as product_count FROM categories c LEFT JOIN products p ON c.id = p.category_id GROUP BY c.id");
$categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="shop-page-header">
    <div class="container">
        <h1 class="shop-title"><?php echo $current_category_slug ? ucfirst(str_replace('-', ' ', $current_category_slug)) : 'All Collections'; ?></h1>
        <div class="breadcrumb">
            <a href="index.php">Home</a> / <span>Shop</span>
        </div>
    </div>
</div>

<div class="shop-container container">
    <!-- Sidebar -->
    <aside class="shop-sidebar">
        <div class="filter-widget">
            <h3 class="filter-title">Categories</h3>
            <ul class="filter-list">
                <li>
                    <a href="shop.php" class="<?php echo !$current_category_slug ? 'active' : ''; ?>">
                        All Jewellery
                    </a>
                </li>
                <?php foreach($categories as $cat): ?>
                <li>
                    <a href="shop.php?category=<?php echo $cat['slug']; ?>" 
                       class="<?php echo $current_category_slug == $cat['slug'] ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                        <span class="count">(<?php echo $cat['product_count']; ?>)</span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="shop-main">
        <div class="shop-toolbar">
            <p class="result-count">Showing <strong><?php echo count($products); ?></strong> results</p>
            <form class="sort-form" method="GET">
                <?php if($current_category_slug): ?><input type="hidden" name="category" value="<?php echo htmlspecialchars($current_category_slug); ?>"><?php endif; ?>
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="newest" <?php echo $sort == 'newest' ? 'selected' : ''; ?>>Newest Arrivals</option>
                    <option value="price_low" <?php echo $sort == 'price_low' ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="price_high" <?php echo $sort == 'price_high' ? 'selected' : ''; ?>>Price: High to Low</option>
                </select>
            </form>
        </div>

        <?php if(count($products) > 0): ?>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product['is_bestseller']): ?>
                            <span class="badge">Bestseller</span>
                        <?php elseif ($product['is_new']): ?>
                            <span class="badge">New</span>
                        <?php endif; ?>
                        
                        <!-- Link to Product Details -->
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>
                        <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <div class="price-row">
                            <span class="price">₹<?php echo number_format($product['sale_price'] ?? $product['price']); ?></span>
                            <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                                <span class="old-price">₹<?php echo number_format($product['price']); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3><a href="product.php?id=<?php echo $product['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                        <p class="desc"><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <p>No products found in this category.</p>
                <a href="shop.php" class="btn-spotlight" style="display:inline-block; margin-top:15px; background:#432858; color:#fff;">View All Products</a>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
