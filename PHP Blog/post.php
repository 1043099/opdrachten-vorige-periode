<?php
require_once 'Classes/Post.php';
require_once 'Classes/Comment.php';
require_once 'Classes/User.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    die('Geen post-ID gevonden.');
}

$postId = $_GET['id'];
$userInstance = new User();
$loggedInUsername = $_SESSION['username'];
$isAuthor = $userInstance->isAuthor($loggedInUsername, $postId);
var_dump($isAuthor);
var_dump($loggedInUsername);

$postInstance = new Post();
$commentInstance = new Comment();

$post = $postInstance->getPostById($postId);
$comments = $commentInstance->getCommentsByPostId($postId);

if (isset($_POST['add_comment'])) {
    $name = $_POST['name'];
    $message = $_POST['message'];

    $commentInstance->addComment($postId, $name, $message);

    header("Location: ".$_SERVER['PHP_SELF']."?id=".$postId);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $post['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="CSS/posts.css">
</head>
<header id="header">
<?php include 'header.php'; ?>
</header>
<body>
    <h1><?php echo $post['title']; ?></h1>
    <p><strong>Auteur:</strong> <?php echo $post['username']; ?></p>
    <p><?php echo $post['description']; ?></p>
    <p><?php echo $post['content']; ?></p>
    <?php if ($isAuthor) : ?>
        <button><a id="coolbutton" href="Backend/edit_post.php?id=<?php echo $post['id']; ?>">Bewerken</a></button>
        <button><a id="coolbutton" href="Backend/delete_post.php?id=<?php echo $post['id']; ?>">Verwijderen</a></button>
    <?php endif; ?>

    <h2>Reacties</h2>
    <?php if (is_array($comments)) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <p><strong>Naam:</strong> <?php echo $comment['name']; ?></p>
                <p><strong>Reactie:</strong> <?php echo $comment['message']; ?></p>
                <p><strong>Tijd:</strong> <?php echo $comment['created_on']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Er zijn geen reacties.</p>
    <?php endif; ?>

    <!-- Commentaarformulier -->
    <h2>Plaats een reactie</h2>
    <form method="POST" action="">
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <label for="name">Naam:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="message">Reactie:</label>
        <textarea name="message" id="message" required></textarea><br>
        <input type="submit" name="add_comment" value="Plaatsen">
    </form>
</body>
</html>