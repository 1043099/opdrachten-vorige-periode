<?php
require_once 'Classes/User.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userInstance = new User();
    $user = $userInstance->login($username, $password);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header('Location: admin.php');
        exit;
    } else {
        $errorMessage = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/createpost.css">
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($errorMessage)) : ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="Inloggen">
    </form>
</body>
</html>