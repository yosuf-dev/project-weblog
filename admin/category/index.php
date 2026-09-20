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
            <h1>Categories</h1>
            <p>Organize content with simple reusable categories.</p>
          </div>
          <a class="btn btn-primary" href="<?= url('admin/category/create.php') ?>">+ Create Category</a>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              global $pdo;
              $query = "SELECT * FROM php_project.categories";
              $statement = $pdo->prepare($query);
              $statement->execute();
              $categories = $statement->fetchAll();
              if (empty($categories)) {
                $query = "TRUNCATE TABLE `categories`;";
                $statement = $pdo->prepare($query);
                $statement->execute();
              }
              foreach ($categories as $category) {
              ?>
                <tr>
                  <td><?= $category->id ?></td>
                  <td><?= $category->name ?></td>
                  <td><?= $category->created_at ?></td>
                  <td>
                    <div class="actions">
                      <a class="action-link" href="<?= url('admin/category/edit.php?cat_id=') . $category->id ?>">Edit</a><a class="action-link delete" href="<?= url('admin/category/delete.php?cat_id=' . $category->id);?>">Delete</a>
                    </div>
                  </td>
                </tr>
                <tr>
                <?php }; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>

</html>