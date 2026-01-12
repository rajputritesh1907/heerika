<?php
require_once 'config/db.php';
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-banner">
        <img src="assets/images/hero_banner_luxury.png" alt="Aurum Jewels by Heerika">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>AURUM</h1>
                <p class="subtitle">TIMELESS ELEGANCE</p>
                <p class="hero-desc">Discover our exclusive collection of handcrafted diamond jewellery.</p>
                <button class="btn-hero">Explore Collection</button>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section container">
    <div class="section-title-center">
        <h2>Shop By Category</h2>
        <div class="title-underline"></div>
    </div>
    <div class="category-grid">
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/cat_ring_gold.png" alt="Rings">
            </div>
            <h3>Rings</h3>
        </div>
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/cat_earrings_gold.png" alt="Earrings">
            </div>
            <h3>Earrings</h3>
        </div>
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/thumb_pendant.png" alt="Necklaces">
            </div>
            <h3>Necklaces</h3>
        </div>
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/thumb_chain_bracelet.png" alt="Bracelets">
            </div>
            <h3>Bracelets</h3>
        </div>
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/thumb_promise_ring.png" alt="Solitaires">
            </div>
            <h3>Solitaires</h3>
        </div>
        <div class="category-item">
            <div class="cat-img">
                <img src="assets/images/thumb_pendant.png" alt="Mangalsutras">
            </div>
            <h3>Mangalsutras</h3>
        </div>
    </div>
</section>

<!-- Advanced Promotional Grid -->
<section class="promo-grid-v2 container">
    <div class="promo-wrapper">
        <!-- Left Large Banner -->
        <div class="promo-banner-large" style="background-image: url('assets/images/promo_large_necklace.png');">
            <div class="promo-overlay-content">
                <h3>SHAYA</h3>
                <p class="brand-sub">by HEERIKA</p>
                <div class="bottom-text">
                    <h2>One Of A Kind</h2>
                    <p>just like you</p>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="promo-col-right">
            <!-- Top Right Banner -->
            <div class="promo-banner-wide purple-gradient"
                style="background-image: url('assets/images/promo_earrings_purple.png');">
                <div class="promo-text-content">
                    <h2>The Earrings Edit</h2>
                    <p>Made for everyday & more</p>
                    <button class="btn-clean-white">Shop Now</button>
                </div>
            </div>
            <!-- Bottom Right Banner -->
            <div class="promo-banner-wide blue-banner-style">
                <div class="promo-text-content">
                    <p class="sub-lead">Natural Diamonds for everyone!</p>
                    <p class="sub-tiny">Now in <strong>925 silver</strong></p>

                    <div class="discount-row">
                        <div class="discount-text">
                            <span class="upto">UPTO</span>
                            <span class="huge-percent">20<sup class="percent-sign">%</sup></span>
                            <span class="off">OFF</span>
                        </div>
                    </div>
                    <p class="offer-terms">on MRP of ALL Shaya Diamond Jewellery</p>

                    <button class="btn-clean-white">SHOP NOW</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Collections Section -->
<section class="collections-section">
    <div class="collections-header">
        <h2 class="co-title">Heerika Collections</h2>
        <div class="title-underline"></div>
    </div>
    <div class="collections-grid container">
        <!-- Card 1 -->
        <div class="collection-card">
            <img src="assets/images/promo_pendant_blue.png" alt="Seaborn">
            <div class="collection-overlay">
                <h3 class="collection-logo">SEABORN</h3>
                <p class="collection-tag">Oceanic Charms</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="collection-card">
            <img src="assets/images/promo_earrings_purple.png" alt="Friends">
            <div class="collection-overlay">
                <h3 class="collection-logo">ROYALE</h3>
                <p class="collection-tag">The Purple Edit</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="collection-card">
            <img src="assets/images/cat_earrings_gold.png" alt="Butterfly">
            <div class="collection-overlay">
                <h3 class="collection-logo">BUTTERFLY</h3>
                <p class="collection-tag">The Spirit of You</p>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="collection-card">
            <img src="assets/images/promo_large_necklace.png" alt="Sol">
            <div class="collection-overlay">
                <h3 class="collection-logo">SOL</h3>
                <p class="collection-tag">Dawn of Brilliance</p>
            </div>
        </div>
    </div>
</section>

<!-- Gifting Strip Section -->
<section class="gifting-strip-section container">
    <div class="gifting-container">
        <!-- Left Side: Gift Icon -->
        <div class="gift-left-col">
            <img src="assets/images/icon_gift_lavender.png" alt="Gift">
            <h3>Wrapped with love</h3>
        </div>

        <!-- Right Side: Scrollable Categories -->
        <div class="gift-right-scroll">
            <!-- Item 1 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_promise_ring.png" alt="Promise Rings">
                </div>
                <p>PROMISE RINGS</p>
            </div>
            <!-- Item 2 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_pendant.png" alt="Pendants">
                </div>
                <p>9KT PENDANTS UNDER 20K</p>
            </div>
            <!-- Item 3 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_chain_bracelet.png" alt="Bracelets">
                </div>
                <p>FUN CHAIN BRACELETS</p>
            </div>
            <!-- Item 4 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_knot_earrings.png" alt="Gifts Under 10k">
                </div>
                <p>GIFTS UNDER 10K</p>
            </div>
            <!-- Item 5 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_diamond_huggies.png" alt="14kt Earrings">
                </div>
                <p>14KT EARRINGS</p>
            </div>
            <!-- Item 6 -->
            <div class="gift-item">
                <div class="gift-thumb">
                    <img src="assets/images/thumb_white_gold_hoops.png" alt="White Gold">
                </div>
                <p>WHITE GOLD DESIGNS</p>
            </div>
        </div>
    </div>
</section>

<!-- Spotlight Slider Section -->
<section class="spotlight-section container">
    <div class="spotlight-wrapper" id="spotlightWrapper">
        <!-- Card 1: Forever Kit -->
        <div class="spotlight-card card-forever">
            <div class="spotlight-content">
                <h3 class="spotlight-title">FOREVER KIT</h3>
                <p class="spotlight-subtitle">The perfect beginning of your story</p>
                <button class="btn-spotlight">SHOP NOW</button>
            </div>
        </div>
        
        <!-- Card 2: Everyday 22KT -->
        <div class="spotlight-card card-everyday">
            <img src="assets/images/cat_earrings_gold.png" class="card-everyday-img" alt="Gold Earrings">
            <div class="spotlight-content">
                <h3 class="spotlight-title">Everyday 22KT</h3>
                <p class="spotlight-subtitle">For the modern woman</p>
                <button class="btn-spotlight">SHOP NOW</button>
            </div>
        </div>

        <!-- Card 3: Sizzle -->
        <div class="spotlight-card card-sizzle">
            <div class="spotlight-content">
                <h3 class="spotlight-title">SIZZLE</h3>
                <p class="spotlight-subtitle">For moments that shine</p>
                <button class="btn-spotlight">EXPLORE</button>
            </div>
        </div>
    </div>

    <div class="spotlight-footer">
        <div class="slide-indicators">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="badge-counter">3/3</span>
        </div>
        <div class="spotlight-controls">
            <button class="control-btn" onclick="document.getElementById('spotlightWrapper').scrollBy({left: -400, behavior: 'smooth'})"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="control-btn" onclick="document.getElementById('spotlightWrapper').scrollBy({left: 400, behavior: 'smooth'})"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
</section>

<!-- Featured Products (Dynamic) -->
<section class="featured-products container">
    <div class="section-header">
        <h2>Best Sellers</h2>
        <a href="#" class="view-all">View All</a>
    </div>
    <div class="product-grid">
        <?php
        // Fetch Best Sellers
        $stmt = $pdo->prepare("SELECT * FROM products ORDER BY is_bestseller DESC, id DESC LIMIT 4");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product):
        ?>
        <div class="product-card">
            <div class="product-image">
                <?php if ($product['is_bestseller']): ?>
                    <span class="badge">Bestseller</span>
                <?php elseif ($product['is_new']): ?>
                    <span class="badge">New</span>
                <?php endif; ?>
                
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="product-info">
                <div class="price-row">
                    <span class="price">₹<?php echo number_format($product['sale_price'] ?? $product['price']); ?></span>
                    <?php if ($product['sale_price'] && $product['sale_price'] < $product['price']): ?>
                        <span class="old-price">₹<?php echo number_format($product['price']); ?></span>
                    <?php endif; ?>
                </div>
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="desc"><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Trust Markers -->
<section class="trust-markers container">
    <div class="marker">
        <i class="fa-solid fa-certificate"></i>
        <h4>100% Certified</h4>
    </div>
    <div class="marker">
        <i class="fa-solid fa-rotate-left"></i>
        <h4>15 Day Returns</h4>
    </div>
    <div class="marker">
        <i class="fa-solid fa-truck-fast"></i>
        <h4>Free Shipping</h4>
    </div>
    <div class="marker">
        <i class="fa-regular fa-gem"></i>
        <h4>Lifetime Exchange</h4>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
