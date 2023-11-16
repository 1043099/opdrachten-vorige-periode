<?php
require '../Classes/Post.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    die('Geen post-ID gevonden.');
}

$postId = $_GET['id'];

$post = new Post();
$currentPost = $post->getPostById($postId);

if (!$currentPost || $currentPost['username'] !== $_SESSION['username']) {
    die('Je hebt geen toegang tot deze post.');
}

if (isset($_POST['delete'])) {
    $post->deletePost($postId);
    header('Location: ../posts.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Verwijder Post</title>
</head>
<body>
    <h1>Verwijder Post</h1>

    <p>Weet je zeker dat je deze post wilt verwijderen?</p>

    <form method="POST" action="delete_post.php?id=<?php echo $postId; ?>">
        <input type="submit" name="delete" value="Verwijderen">
    </form>
</body>
</html>