<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AdminSpace</title>
    <link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>" />
</head>

<body>
    <div class="layout">
        <?php require_once '../layouts/sidbar.php' ?>

        <div class="main-area">
            <?php require_once '../layouts/nav-top.php' ?>

            <main class="content">
                <div class="page-heading">
                    <div>
                        <h1>Posts</h1>
                        <p>
                            Review articles, categories, and their current visual status.
                        </p>
                    </div>
                    <a class="btn btn-primary" href="<?= url('admin/post/create.php') ?>">+ Create Post</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>body</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $pdo;
                            $query = "SELECT php_project.posts.* ,php_project.categories.name as `category_name`  FROM php_project.posts LEFT JOIN php_project.categories ON php_project.posts.cat_id = php_project.categories.id";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $posts = $statement->fetchAll();
                            if (empty($posts)) {
                                $query = "TRUNCATE TABLE `posts`;";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                            }
                            foreach ($posts as $post) {
                            ?>
                                <tr>
                                    <td><?= $post->id ?></td>
                                    <td>
                                        <img style="width: 50px;" src="<?= url($post->image) ?>">
                                    </td>
                                    <td><?= $post->title ?></td>
                                    <td><?= $post->category_name ?></td>
                                    <td><?= substr($post->body, 0, 30) . ' ...' ?></td>
                                    <td>
                                        <?php if ($post->status == 10) { ?>
                                            <span class="status published">Published</span>
                                        <?php } else { ?>
                                            <span class="status hidden">Hidden</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a class="action-link" style="background-color: rgb(213, 250, 222);color: green;" href="<?= url('admin/post/change-status.php?post_id=') . $post->id ?>">status</a>
                                            <a class="action-link" href="<?= url('admin/post/edit.php?post_id=') . $post->id ?>">Edit</a>
                                            <a class="action-link delete" href="<?= url('admin/post/delete.php?post_id=') . $post->id ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>