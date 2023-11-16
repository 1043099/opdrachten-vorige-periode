<?php
require_once 'Classes/User.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$userInstance = new User();

$users = $userInstance->getUsers();

if (isset($_POST['delete'])) {
    $userId = $_POST['delete'];
    $userInstance->deleteUser($userId);
    header('Location: users.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gebruikers</title>
    <link rel="stylesheet" type="text/css" href="CSS/users.css">
</head>
<header id="header">
<?php include 'header.php'; ?>
</header>
<body>
    <h1>Gebruikers</h1>

    <table>
        <tr>
            <th>Gebruikersnaam</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td>
                    <form method="POST" action="users.php">
                        <input type="hidden" name="delete" value="<?php echo $user['id']; ?>">
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>