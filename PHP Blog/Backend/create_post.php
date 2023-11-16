<?php
require_once '../Classes/DbConnection.php';
require_once '../Classes/User.php';
require_once '../Classes/Post.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$userInstance = new User();
$postInstance = new Post();

$username = $_SESSION['username'];
$user = $userInstance->getUserByUsername($username);

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    if($postInstance->addPost($title, $description, $content, $userId)) {
        header('Location: ../posts.php');
        exit;
    } else {
        die('Fout bij het toevoegen van de post.');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post aanmaken</title>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePost.css">

</head>
<header id="header">
<?php include '../header.php'; ?>
</header>
<body>
    <h1>Post aanmaken</h1>
    <form method="POST" action="create_post.php">
        <label for="title">Titel:</label>
        <input type="text" name="title" required><br>

        <label for="description">Beschrijving:</label>
        <textarea name="description" required></textarea><br>

        <label for="content">Inhoud:</label>
        <textarea name="content" required></textarea><br>

        <input type="submit" name="create" value="Post aanmaken">
    </form>
</body>
</html>