<?php
require_once '../Classes/User.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

$userInstance = new User();

if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $userInstance->addUser($username, $password);
    
    header('Location: ../users.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gebruiker aanmaken</title>
    <link rel="stylesheet" type="text/css" href="../CSS/createpost.css">
</head>
<header id="header">
<?php include '../header.php'; ?>
</header>
<body>
    <h1>Gebruiker aanmaken</h1>

    <form method="POST" action="create_user.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="create" value="Gebruiker aanmaken">
    </form>
</body>
</html>