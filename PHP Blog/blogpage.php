<?php
require_once 'Classes/Post.php';

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
    <title>Blog Pagina</title>
    <link rel="stylesheet" type="text/css" href="CSS/adminposts.css">
</head>
<body>
    <h1>Blog Pagina</h1>

    <?php foreach ($posts as $post) : ?>
        <div class="post">
            <h2 class="post-title"><?php echo $post['title']; ?></h2>
            <p class="post-description"><?php echo $post['description']; ?></p>
            <a href="post.php?id=<?php echo $post['id']; ?>">Lees meer</a>
        </div>
    <?php endforeach; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>