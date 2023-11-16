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

if (!isset($_GET['id'])) {
    exit('No product ID provided.');
}

$product = $productInstance->getProductById($_GET['id']);

if (!$product) {
    exit('Product not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $product['naam'] ?></title>
</head>

<body>
    <div class="container">
        <h1><?= $product['naam'] ?></h1>
        <p><?= $product['beschrijving'] ?></p>
        <p class="price">Prijs: <?= $product['prijs'] ?></p>
        <p class="available">Aantal beschikbaar: <?= $product['aantal'] ?></p>
    </div>
</body>
</html>