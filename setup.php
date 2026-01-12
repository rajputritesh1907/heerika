<?php
require_once 'config/db.php';

try {
    // 1. Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'customer') DEFAULT 'customer',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Categories Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL UNIQUE,
        image VARCHAR(255)
    )");

    // 3. Products Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT,
        name VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        sale_price DECIMAL(10, 2) DEFAULT NULL,
        image VARCHAR(255),
        stock INT DEFAULT 10,
        is_featured BOOLEAN DEFAULT 0,
        is_bestseller BOOLEAN DEFAULT 0,
        is_new BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    )");

    // 4. Orders Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        total_amount DECIMAL(10, 2) NOT NULL,
        status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
        payment_method VARCHAR(50),
        shipping_address TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    // 5. Order Items Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT,
        product_id INT,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id)
    )");

    echo "Tables created successfully.<br>";

    // --- SEED DATA ---
    
    // Categories
    $categories = [
        ['name' => 'Rings', 'slug' => 'rings', 'image' => 'assets/images/cat_ring_gold.png'],
        ['name' => 'Earrings', 'slug' => 'earrings', 'image' => 'assets/images/cat_earrings_gold.png'],
        ['name' => 'Necklaces', 'slug' => 'necklaces', 'image' => 'assets/images/thumb_pendant.png'],
        ['name' => 'Bracelets', 'slug' => 'bracelets', 'image' => 'assets/images/thumb_chain_bracelet.png'],
        ['name' => 'Solitaires', 'slug' => 'solitaires', 'image' => 'assets/images/thumb_promise_ring.png'],
        ['name' => 'Mangalsutras', 'slug' => 'mangalsutras', 'image' => 'assets/images/thumb_pendant.png']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name, slug, image) VALUES (:name, :slug, :image)");
    foreach ($categories as $cat) {
        $stmt->execute($cat);
    }
    echo "Categories seeded.<br>";

    // Get Category IDs
    $cat_rings = $pdo->query("SELECT id FROM categories WHERE slug='rings'")->fetchColumn();
    $cat_earrings = $pdo->query("SELECT id FROM categories WHERE slug='earrings'")->fetchColumn();
    $cat_bracelets = $pdo->query("SELECT id FROM categories WHERE slug='bracelets'")->fetchColumn();

    // Products (Best Sellers from Home Page)
    $products = [
        [
            'category_id' => $cat_rings,
            'name' => 'Classic Solitaire Ring',
            'slug' => 'classic-solitaire-ring',
            'description' => '18KT Yellow Gold, 2.5g. A timeless classic.',
            'price' => 22000.00,
            'sale_price' => 18500.00,
            'image' => 'assets/images/cat_rings.png',
            'is_bestseller' => 1,
            'is_new' => 0
        ],
        [
            'category_id' => $cat_rings,
            'name' => 'Eternity Band',
            'slug' => 'eternity-band',
            'description' => '14KT Rose Gold, 3.0g. Symbol of endless love.',
            'price' => 28000.00,
            'sale_price' => 24900.00,
            'image' => 'assets/images/cat_rings.png', // Using existing generic ring image for now
            'is_bestseller' => 0,
            'is_new' => 1
        ],
        [
            'category_id' => $cat_earrings,
            'name' => 'Floral Studs',
            'slug' => 'floral-studs',
            'description' => '18KT White Gold, 1.8g. Delicate floral design.',
            'price' => 15000.00,
            'sale_price' => 12000.00,
            'image' => 'assets/images/cat_rings.png', // Placeholder, ideally specific earring image
            'is_bestseller' => 0,
            'is_new' => 0
        ],
        [
            'category_id' => $cat_bracelets,
            'name' => 'Infinity Bracelet',
            'slug' => 'infinity-bracelet',
            'description' => '22KT Gold, 5.0g. Elegant and durable.',
            'price' => 35500.00,
            'sale_price' => NULL,
            'image' => 'assets/images/cat_rings.png', // Placeholder
            'is_bestseller' => 0,
            'is_new' => 0
        ]
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO products (category_id, name, slug, description, price, sale_price, image, is_bestseller, is_new) VALUES (:category_id, :name, :slug, :description, :price, :sale_price, :image, :is_bestseller, :is_new)");
    
    foreach ($products as $prod) {
        $stmt->execute($prod);
    }
    echo "Products seeded.<br>";
    
    echo "Database setup complete! You can now visit index.php";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
