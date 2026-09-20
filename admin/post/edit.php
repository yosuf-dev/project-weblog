<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

if (!isset($_GET['post_id'])) {
    redirect('admin/post');
}

global $pdo;

$query = "SELECT * FROM php_project.posts WHERE id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();
if ($post === false) {
    redirect('admin/post');
}


if (
    isset($_POST['title']) && $_POST['title'] !== ''
    && isset($_POST['body']) && $_POST['body'] !== ''
    && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
) {

    if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') {

        $arrowedMimes = ['png', 'jpeg', 'jpg', 'gif'];

        $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (!in_array($imageMime, $arrowedMimes)) {
            redirect('admin/post');
        }

        $basePath = dirname(dirname(__DIR__));

        if(file_exists($basePath . $post->image)){
            unlink($basePath . $post->image);
        }
        $image = '/assets/images/post/' . date('Y_m_d_H_i_s'). '.' . $imageMime;
        $image_updoad = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

        if ($category !== false && $image_updoad !== false) {
            global $pdo;
            $query = "UPDATE php_project.posts SET title= ? , body= ?, cat_id = ?, image = ?, uplated_at = NOW() WHERE id = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['body'], $_POST['cat_id'], $image, $_GET['post_id']]);
        }
    } else {
        if ($category !== false) {
            global $pdo;
            $query = "UPDATE php_project.posts SET title= ? , body= ?, cat_id = ?, uplated_at = NOW() WHERE id = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['body'], $_POST['cat_id'], $_GET['post_id']]);
        }
    }
    redirect('admin/post');
};
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Post — AdminSpace</title>
    <link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="form-card">
            <h1>Edit Post</h1>
            <p>Update the post information below.</p>
            <form action="<?= url('admin/post/edit.php?post_id=') . $post->id ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post-title">Post Title</label><input
                    name="title"
                        class="input"
                        id="post-title"
                        type="text"
                        value="<?= $post->title ?>"
                        placeholder="Enter post title"
                        required />
                </div>
                <div class="form-group">
                    <label for="post-content">body</label>
                    <textarea class="input" id="post-content" name="body"><?= $post->body ?></textarea>
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
                            <option value="<?= $category->id ?>" <?php if ($category->id == $post->cat_id) {echo 'selected';} ?>><?= $category->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-image">Post Image</label><input
                    name="image"
                        class="input"
                        id="post-image"
                        type="file"
                        accept="image/*" />
                    <img src="<?= url($post->image) ?>" style="width: 100%; margin-top: 20px;" />
                </div>
                <div class="form-actions">
                    <a class="btn btn-light" href="<?= url('admin/post') ?>">Cancel</a><button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>