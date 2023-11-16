<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); 
}

require_once 'Classes/Database.php';
require_once 'Classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->handlePostRequest();

$users = $user->getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
   
</head>
<body>

<h1>User Management</h1>

<h2>Add User</h2>
<form method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Voornaam: <input type="text" name="voornaam"><br>
    Tussenvoegsel: <input type="text" name="tussenvoegsel"><br>
    Achternaam: <input type="text" name="achternaam"><br>
    Adres: <input type="text" name="adres"><br>
    Postcode: <input type="text" name="postcode"><br>
    Telefoon: <input type="text" name="telefoon"><br>
    <input type="submit" name="add" value="Add User">
</form>

<h2>View Users</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Adres</th>
        <th>Postcode</th>
        <th>Telefoon</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <form method="post">
        <tr>
            <td><?= $user['id'] ?></td>
            <td><input type="text" name="username" value="<?= $user['username'] ?>"></td>
            <td><input type="password" name="password" value="" placeholder="Enter new password to update"></td>
            <td><input type="text" name="voornaam" value="<?= $user['voornaam'] ?>"></td>
            <td><input type="text" name="tussenvoegsel" value="<?= $user['tussenvoegsel'] ?>"></td>
            <td><input type="text" name="achternaam" value="<?= $user['achternaam'] ?>"></td>
            <td><input type="text" name="adres" value="<?= $user['adres'] ?>"></td>
            <td><input type="text" name="postcode" value="<?= $user['postcode'] ?>"></td>
            <td><input type="text" name="telefoon" value="<?= $user['telefoon'] ?>"></td>
            <td>
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <input type="submit" name="delete" value="Delete">
                <input type="submit" name="update" value="Update">
            </td>
        </tr>
    </form>
    <?php endforeach; ?>
</table>
</body>
</html>