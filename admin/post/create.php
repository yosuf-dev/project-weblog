<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';



if (
    isset($_POST['title']) && $_POST['title'] !== ''
    && isset($_POST['body']) && $_POST['body'] !== ''
    && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
    && isset($_FILES['image']) && $_FILES['image']['name'] !== ''
) {

    $arrowedMimes = ['png', 'jpeg', 'jpg', 'gif'];

    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (!in_array($imageMime, $arrowedMimes)) {
        redirect('admin/post');
    }

    $basePath = dirname(dirname(__DIR__));
    $image = '/assets/images/post/' . date('Y_m_d_H_i_s'). '.' . $imageMime;
    $image_updoad = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

    if ($category !== false && $image_updoad !== false) {
        global $pdo;
        $query = "INSERT INTO php_project.posts SET title= ? , body= ?, cat_id = ?, image = ?, created_at = NOW();";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['title'], $_POST['body'], $_POST['cat_id'], $image]);
    }
    redirect('admin/post');
};


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Post — AdminSpace</title>
    <link rel="stylesheet" href="<?= asset('/assets/css/admin.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="form-card">
            <h1>Create Post</h1>
            <p>Create a new post using the form below.</p>
            <form action="<?= url('admin/post/create.php') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post-title">Post Title</label><input
                        name="title"
                        class="input"
                        id="post-title"
                        type="text"
                        value=""
                        placeholder="Enter post title"
                        required />
                </div>
                <div class="form-group">
                    <label for="post-content">body</label><textarea name="body" class="input" id="post-content">
Write the complete article content here.</textarea>
                </div>
                <div class="form-group">
                    <label for="post-category">Category</label><select class="input" name="cat_id" id="post-category">
                        <?php
                        global $pdo;
                        $query = "SELECT * FROM php_project.categories";
                        $statement = $pdo->prepare($query);
                        $statement->execute();
                        $categories = $statement->fetchAll();
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-image">Post Image</label><input
                        class="input"
                        id="post-image"
                        type="file"
                        name="image"
                        accept="image/*" />
                </div>
                <div class="form-actions">
                    <a class="btn btn-light" href="<?= url('admin/post') ?>">Cancel</a><button class="btn btn-primary" type="submit">Create Post</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>