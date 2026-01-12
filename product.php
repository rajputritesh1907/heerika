<?php
require_once 'config/db.php';
include 'includes/header.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id");
$stmt->execute([':id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<div class='container' style='padding:50px; text-align:center;'><h2>Product not found</h2><a href='shop.php'>Go to Shop</a></div>";
    include 'includes/footer.php';
    exit;
}
?>

<div class="container" style="margin-top: 40px; margin-bottom: 60px;">
    <div class="breadcrumb" style="margin-bottom: 30px;">
        <a href="index.php">Home</a> / <a href="shop.php">Shop</a> / <a href="shop.php?category=<?php echo htmlspecialchars($product['category_name']); ?>"><?php echo htmlspecialchars($product['category_name']); ?></a> / <span><?php echo htmlspecialchars($product['name']); ?></span>
    </div>

    <div class="product-details-wrapper" style="display: flex; gap: 50px;">
        <!-- Left: Image -->
        <div class="product-gallery" style="flex: 1;">
            <div class="main-image" style="background: #f9f9f9; border-radius: 12px; overflow: hidden;">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: auto; display: block;">
            </div>
        </div>

        <!-- Right: Info -->
        <div class="product-info-col" style="flex: 1;">
            <h1 style="font-family: var(--font-heading); font-size: 2.2rem; color: #432858; margin-bottom: 10px;"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="sku" style="font-size: 0.9rem; color: #888; margin-bottom: 20px;">SKU: HE-<?php echo str_pad($product['id'], 4, '0', STR_PAD_LEFT); ?></p>

            <div class="price-block" style="margin-bottom: 25px;">
                <span class="current-price" style="font-size: 2rem; font-weight: 600; color: #333;">₹<?php echo number_format($product['sale_price'] ?? $product['price']); ?></span>
                <?php if ($product['sale_price']): ?>
                    <span class="old-price" style="text-decoration: line-through; color: #999; margin-left: 10px; font-size: 1.2rem;">₹<?php echo number_format($product['price']); ?></span>
                    <span class="discount-tag" style="background: #e6f7e6; color: #2e7d32; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; margin-left: 10px; font-weight: 600;">SAVE ₹<?php echo number_format($product['price'] - $product['sale_price']); ?></span>
                <?php endif; ?>
                <p style="font-size: 0.85rem; color: #666; margin-top: 5px;">Inclusive of all taxes</p>
            </div>

            <div class="description" style="margin-bottom: 30px; line-height: 1.6; color: #555;">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
            </div>

            <!-- Add to Cart Actions -->
            <div class="actions" style="display: flex; gap: 15px; margin-bottom: 30px;">
                <input type="number" value="1" min="1" style="width: 60px; padding: 10px; border: 1px solid #ddd; border-radius: 6px; text-align: center;">
                <button style="flex: 1; background: #432858; color: #fff; border: none; padding: 12px 25px; border-radius: 6px; font-weight: 600; cursor: pointer;">ADD TO CART</button>
                <button style="width: 50px; background: #fdfbff; border: 1px solid #432858; color: #432858; border-radius: 6px; cursor: pointer;"><i class="fa-regular fa-heart"></i></button>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">

            <div class="meta-info">
                <p style="margin-bottom: 10px;"><strong style="color: #333;">Category:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
                <p style="margin-bottom: 10px;"><strong style="color: #333;">Availability:</strong> <span style="color: #2e7d32;">In Stock</span></p>
                <div class="services" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check-circle" style="color: #432858;"></i> Certified Jewellery
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check-circle" style="color: #432858;"></i> 14 Day Returns
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check-circle" style="color: #432858;"></i> Free Shipping
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check-circle" style="color: #432858;"></i> Bis Hallmark
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
