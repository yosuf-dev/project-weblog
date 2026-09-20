<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

if (isset($_POST['name']) && $_POST['name'] !== '') {
    global $pdo;
    $query = "INSERT INTO php_project.categories SET name= ?, created_at = NOW();";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name']]);
    redirect('admin/category');
};

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Category — AdminSpace</title>
    <link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="form-card">
            <h1>Create Category</h1>
            <p>Add a clear name and short description for your category.</p>
            <form action="<?= url('admin/category/create.php') ?>" method="post">
                <div class="form-group">
                    <label for="cat-name">Category Name</label><input
                        name="name"
                        class="input"
                        id="cat-name"
                        type="text"
                        placeholder="e.g. Technology"
                        autofocus
                        required />
                </div>
                <div class="form-actions">
                    <a class="btn btn-light" href="<?= url('admin/category') ?>">Cancel</a><button class="btn btn-primary" type="submit">
                        Create Category
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>