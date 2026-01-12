<?php
require_once '../config/db.php';
include 'includes/header.php';

$message = '';
$error = '';

if (isset($_POST['import'])) {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $fileName = $_FILES['csv_file']['tmp_name'];
        
        if ($_FILES['csv_file']['size'] > 0) {
            $file = fopen($fileName, "r");
            
            // Skip the first line (headers)
            fgetcsv($file);
            
            $count = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                // Expected Format: Name, Category, Price, Sale Price, Description, ImageURL
                // Adjust indices based on your preferred CSV format. 
                // Let's assume: 0:Name, 1:Category, 2:Price, 3:SalePrice, 4:Description, 5:Image, 6:Bestseller(0/1), 7:New(0/1)
                
                $name = $column[0] ?? '';
                $category_name = $column[1] ?? 'Other'; // Default category
                $price = $column[2] ?? 0;
                $sale_price = !empty($column[3]) ? $column[3] : NULL;
                $description = $column[4] ?? '';
                $image = $column[5] ?? 'assets/images/placeholder.png';
                $is_bestseller = $column[6] ?? 0;
                $is_new = $column[7] ?? 0;

                if (empty($name)) continue;

                // 1. Get or Create Category ID
                $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = ? LIMIT 1");
                $stmt->execute([$category_name]);
                $cat_id = $stmt->fetchColumn();

                if (!$cat_id) {
                    // Create category if it doesn't exist
                    $cat_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category_name)));
                    $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
                    try {
                        $stmt->execute([$category_name, $cat_slug]);
                        $cat_id = $pdo->lastInsertId();
                    } catch(Exception $e) {
                         $cat_id = 1; // Fallback to a default if error (or create a 'General' category beforehand)
                    }
                }

                // 2. Generate Slug
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
                
                // 3. Insert Product
                try {
                    $insert = $pdo->prepare("INSERT INTO products (name, slug, category_id, price, sale_price, description, image, is_bestseller, is_new) 
                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insert->execute([$name, $slug, $cat_id, $price, $sale_price, $description, $image, $is_bestseller, $is_new]);
                    $count++;
                } catch(PDOException $e) {
                    // Skip if duplicate slug or other error, or log it
                   // $error .= "Error importing $name: " . $e->getMessage() . "<br>";
                }
            }
            $message = "Successfully imported $count products.";
            fclose($file);
        }
    } else {
        $error = "Please select a valid CSV file.";
    }
}
?>

<div class="page-header">
    <h1 class="page-title">Import Products</h1>
    <a href="products.php" class="btn-sm btn-primary">Back to List</a>
</div>

<?php if($message): ?>
    <div style="background:#d4edda; color:#155724; padding:15px; border-radius:4px; margin-bottom:20px;"><?php echo $message; ?></div>
<?php endif; ?>

<?php if($error): ?>
    <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:4px; margin-bottom:20px;"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-container">
    <div style="margin-bottom: 20px; padding: 15px; background: #e9ecef; border-radius: 4px;">
        <strong>CSV Format Guide:</strong><br>
        <small>Name, Category, Price, Sale Price, Description, Image Path, Bestseller(1/0), New(1/0)</small>
        <br>
        <small>Example: <i>"Gold Ring", "Rings", 5000, 4500, "Nice ring", "assets/images/ring.png", 1, 0</i></small>
    </div>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload CSV File</label>
            <input type="file" name="csv_file" class="form-control" accept=".csv" required>
        </div>
        <button type="submit" name="import" class="btn-sm btn-primary" style="padding: 12px 30px; font-size: 1rem;">Import Now</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
