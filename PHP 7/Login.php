<?php
require_once 'Classes/Database.php';
require_once 'Classes/User.php';

$dbInstance = (new Database())->getConnection();
$userInstance = new User($dbInstance);

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($userInstance->login($username, $password)) {
        header("Location: products.php");
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
        <?php if(!empty($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>