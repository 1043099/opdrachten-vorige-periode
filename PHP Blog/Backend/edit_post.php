<?php
require '../Classes/Post.php';

if (!isset($_GET['id'])) {
    die('Geen post-ID gevonden.');
}

$postId = $_GET['id'];

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

$postObj = new Post();

$post = $postObj->getPostById($postId);

if (!$post || $_SESSION['username'] != $post['username']) {
    die('Je hebt geen toegang tot deze post.');
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $postObj->updatePost($postId, $title, $description, $content);

    header('Location: ../post.php?id=' . $postId);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bewerk Post</title>
    <link rel="stylesheet" type="text/css" href="../CSS/createpost.css">

</head>
<body>
    <h1>Bewerk Post</h1>

    <form method="POST" action="edit_post.php?id=<?php echo $postId; ?>">
        <label for="title">Titel:</label>
        <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br>

        <label for="description">Beschrijving:</label>
        <textarea name="description" required><?php echo $post['description']; ?></textarea><br>

        <label for="content">Inhoud:</label>
        <textarea name="content" required><?php echo $post['content']; ?></textarea><br>

        <input type="submit" name="update" value="Bijwerken">
    </form>
</body>
</html>