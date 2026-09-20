<?php
require_once 'functions/helpers.php';
require_once 'functions/pdo_connection.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Postify — modern stories and articles." />
    <title>Postify — Latest Posts</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
</head>

<body>
    <?php require_once 'layouts/top-nav.php' ?>
    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-card">
                    <span class="hero-eyebrow">Postify Journal</span>
                    <h1>Latest Posts</h1>
                    <p>
                        Discover interesting stories, ideas, and articles across sport,
                        business, culture, and technology.
                    </p>
                </div>
            </div>
        </section>
        <section class="container section">
            <div class="posts-grid">
                <?php
                global $pdo;
                $query = "SELECT php_project.posts.* ,php_project.categories.name as `category_name`  FROM php_project.posts LEFT JOIN php_project.categories ON php_project.posts.cat_id = php_project.categories.id WHERE php_project.posts.status = 10";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $posts = $statement->fetchAll();
                foreach ($posts as $post) {
                ?>
                    <article class="post-card">
                        <img
                            src="<?= url($post->image) ?>"/>
                        <div class="card-content">
                            <a href="<?= url('category.php?cat_id='). $post->cat_id ?>" class="category-tag"><?= $post->category_name ?></a>
                            <h3><?= substr($post->title, 0 , 60) ?></h3>
                            <p>
                                <?= substr($post->body, 0 , 80) ?>...
                            </p>
                            <a class="card-link" href="<?= url('detail.php?post_id=') . $post->id ?>">View Details <span>→</span></a>
                        </div>
                    </article>

                <?php } ?>
            </div>
        </section>
    </main>
</body>

</html>