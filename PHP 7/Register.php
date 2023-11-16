<?php
require_once 'Classes/Database.php';
require_once 'Classes/User.php';

$dbInstance = (new Database())->getConnection();
$userInstance = new User($dbInstance);

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'voornaam' => $_POST['voornaam'],
        'tussenvoegsel' => $_POST['tussenvoegsel'],
        'achternaam' => $_POST['achternaam'],
        'adres' => $_POST['adres'],
        'postcode' => $_POST['postcode'],
        'telefoon' => $_POST['telefoon']
    ];

    try {
        $userInstance->addUser($userData);
        $success = "Registration successful!";
    } catch (Exception $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <label for="voornaam">Voornaam:</label>
        <input type="text" name="voornaam" required><br>
        <label for="tussenvoegsel">Tussenvoegsel:</label>
        <input type="text" name="tussenvoegsel"><br>
        <label for="achternaam">Achternaam:</label>
        <input type="text" name="achternaam" required><br>
        <label for="adres">Adres:</label>
        <input type="text" name="adres" required><br>
        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" required><br>
        <label for="telefoon">Telefoon:</label>
        <input type="text" name="telefoon" required><br>
        <input type="submit" value="Register">
        <?php if(!empty($error)) echo "<p>$error</p>"; ?>
        <?php if(!empty($success)) echo "<p>$success</p>"; ?>
    </form>
</body>
</html>