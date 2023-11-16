<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit(); 
}

require_once 'Classes/Database.php';
require_once 'Classes/Product.php';

$dbInstance = (new Database())->getConnection();
$productInstance = new Product($dbInstance);

$products = array_filter($productInstance->getAllProducts(), function($product) {
    return $product['aantal'] > 0;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    
</head>
<body>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <a href="view_product.php?id=<?= $product['id'] ?>" class="product-link">
                <div class="product">
                    <h3><?= $product['naam'] ?></h3>
                    <p><?= $product['beschrijving'] ?></p>
                    <p>Prijs: $<?= number_format($product['prijs'], 2) ?></p>
                    <p>Aantal: <?= $product['aantal'] ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>