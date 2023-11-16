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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['delete'])) {
        $productInstance->deleteProduct($_POST['id']);
    } elseif(isset($_POST['update'])) {
        $productInstance->updateProduct($_POST['id'], $_POST['naam'], $_POST['beschrijving'], $_POST['prijs'], $_POST['aantal']);
    } elseif(isset($_POST['add_product'])) {
        $naam = $_POST['naam'];
        $beschrijving = $_POST['beschrijving'];
        $prijs = floatval($_POST['prijs']);
        $aantal = intval($_POST['aantal']);
        $productInstance->addProduct($naam, $beschrijving, $prijs, $aantal);
    }
}

$products = $productInstance->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    
</head>
<body>
    <div id="add-product-section" class="active-section">
        <h2>Add New Product</h2>
        <form action="" method="post">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" id="naam" required>
            
            <label for="beschrijving">Beschrijving:</label>
            <textarea name="beschrijving" id="beschrijving" required></textarea>
            
            <label for="prijs">Prijs:</label>
            <input type="number" name="prijs" id="prijs" step="0.01" required>
            
            <label for="aantal">Aantal:</label>
            <input type="number" name="aantal" id="aantal" required>
            
            <input type="submit" name="add_product" value="Add Product">
        </form>
        <?php if(!empty($error)) echo "<p>$error</p>"; ?>
        <?php if(!empty($success)) echo "<p class='success'>$success</p>"; ?>
    </div>

    <div id="edit-remove-section">
        <h2>Edit/Remove Products</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <form method="post">
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><input type="text" name="naam" value="<?= $product['naam'] ?>"></td>
                    <td><textarea name="beschrijving"><?= $product['beschrijving'] ?></textarea></td>
                    <td><input type="number" name="prijs" step="0.01" value="<?= $product['prijs'] ?>"></td>
                    <td><input type="number" name="aantal" value="<?= $product['aantal'] ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="submit" name="delete" value="Delete">
                        <input type="submit" name="update" value="Update">
                    </td>
                </tr>
            </form>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>