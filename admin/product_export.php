<?php
require_once '../config/db.php';

// Set headers to force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=products_export_' . date('Y-m-d') . '.csv');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('ID', 'Name', 'Category', 'Price', 'Sale Price', 'Description', 'Image', 'Slug', 'Is Bestseller', 'Is New'));

// Fetch the data
$sql = "SELECT p.id, p.name, c.name as category_name, p.price, p.sale_price, p.description, p.image, p.slug, p.is_bestseller, p.is_new 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        ORDER BY p.id ASC";
$stmt = $pdo->query($sql);

// Loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
