<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

global $pdo;

if (!isset($_GET)) {
    redirect('admin/category');
};


$query = "SELECT * FROM php_project.categories WHERE id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['cat_id']]);
$category = $statement->fetch();
if ($category === false) {
    redirect('admin/category');
}

if (isset($_POST['name']) && $_POST['name'] !== '') {
    global $pdo;
    $query = "UPDATE php_project.categories SET name= ?, updated_at = NOW() WhERE id = ?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name'], $_GET['cat_id']]);
    redirect('admin/category');
};
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Category — AdminSpace</title>
    <link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="form-card">
            <h1>Edit Category</h1>
            <p>Update the category information below.</p>
            <form action="<?= url('admin/category/edit.php?cat_id=') . $_GET['cat_id'] ?>" method="post">
                <div class="form-group">
                    <label for="cat-name">Category Name</label><input
                        class="input"
                        id="cat-name"
                        type="text"
                        name="name"
                        value="<?= $category->name ?>"
                        placeholder="e.g. Technology"
                        autofocus
                        required />
                </div>
                <div class="form-actions">
                    <a class="btn btn-light" href="<?= url('admin/category') ?>">Cancel</a><button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>