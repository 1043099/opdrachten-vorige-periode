<?php
require_once 'Classes/Post.php';
if(!isset($_SESSION))
{
    session_start();
}  if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}
$post = new Post();

$postsPerPage = 6;

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $postsPerPage;
$posts = $post->getPosts($postsPerPage, $offset);
$totalPosts = $post->getTotalPosts();
$totalPages = ceil($totalPosts / $postsPerPage);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" type="text/css" href="CSS/adminposts.css">
</head>
<header id="header">
<?php include 'header.php'; ?>
</header>
<body><br>
    <h1>Posts</h1>
    <?php foreach ($posts as $post) : ?>
        <div class="post">
            <h2><?php echo $post['title']; ?></h2>
            <p><?php echo $post['description']; ?></p>
            <button><a href="post.php?id=<?php echo $post['id']; ?>">Lees meer</a></button>
        </div>
    <?php endforeach; ?>

    <div class="pagination">
        <br>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <button><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></button>
        <?php endfor; ?>
    </div>
</body>
</html>