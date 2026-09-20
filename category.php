<?php
require_once 'functions/helpers.php';
require_once 'functions/pdo_connection.php';
global $pdo;
$notFound = false;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Economic — Postify</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
</head>

<body>
    <style>
        .category-header__line {
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--dark), transparent, transparent);
            border-radius: 100px;
        }
    </style>
    <?php require_once 'layouts/top-nav.php' ?>
    <main>
        <?php 
        if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
            $query = "SELECT * FROM php_project.categories WHERE id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['cat_id']]);
            $category = $statement->fetch();
            if($category !== false){
        ?>
            <section class="category-header">
                <div class="container">
                    <h1><?= $category->name ?></h1>
                    <p class="category-header__line"></p>
                </div>
            </section>
            <section class="container section">
                <div class="posts-grid">
                    <?php
                    global $pdo;
                    $query = "SELECT php_project.posts.* ,php_project.categories.name as `category_name`  FROM php_project.posts LEFT JOIN php_project.categories ON php_project.posts.cat_id = php_project.categories.id WHERE php_project.posts.status = 10 AND php_project.posts.cat_id = ?";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_GET['cat_id']]);
                    $posts = $statement->fetchAll();
                        foreach ($posts as $post) {
                    ?>
                        <article class="post-card">
                            <img
                                src="<?= url($post->image) ?>" />
                            <div class="card-content">
                                <h3><?= substr($post->title, 0, 60) ?></h3>
                                <p>
                                    <?= substr($post->body, 0, 80) ?>...
                                </p>
                                <a class="card-link" href="<?= url('detail.php?post_id=') . $post->id ?>">View Details <span>→</span></a>
                            </div>
                        </article>

                    <?php } ?>
                </div>
            </section>
        <?php
            }else{$notFound = true;}
             } else {$notFound = true;}
        if ($notFound === true) { ?>
            <h1>Category Not Found!</h1>
        <?php } ?>
    </main>
</body>

</html>