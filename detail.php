<?php
require_once 'functions/helpers.php';
require_once 'functions/pdo_connection.php';

global $pdo;
$query = "SELECT php_project.posts.* ,php_project.categories.name as `category_name`  FROM php_project.posts JOIN php_project.categories ON php_project.posts.cat_id = php_project.categories.id WHERE php_project.posts.id = ? AND php_project.posts.status = 10";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Future of Modern Football Training — Postify</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
</head>

<body>
    <main class="article-page">
        <?php if($post!==false){ ?>
        <article class="article-container">
            <img
                src="<?= url($post->image) ?>" />
            <div class="article-content">
                <a href="<?= url('category.php?cat_id='). $post->cat_id ?>" class="category-tag"><?= $post->category_name ?></a>
                <h1><?= $post->title ?></h1>
                <div class="article-text">
                    <p>
                        <?= $post->body ?>
                    </p>
                </div>
                <a class="back-link" href="<?= url('') ?>">← Back</a>
            </div>
        </article>
        <?php }else{ ?>
            <h1>post not found!</h1>
        <?php } ?>
    </main>
</body>

</html>