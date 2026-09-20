    <header class="site-nav">
      <div class="container nav-inner">
        <a class="brand" href="<?= url('admin') ?>">Postify</a>
        <nav class="nav-links" aria-label="Main navigation">
          <a href="<?= url('') ?>" class="">Home</a>
          <?php
          session_start();
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
            <a href="<?= url('category.php?cat_id='). $category->id ?>" class=""><?= $category->name ?></a>
          <?php } ?>
        </nav>
        <div class="nav-actions">
          <?php 
          if(!isset($_SESSION['users'])){
          ?>
          <a class="btn btn-light" href="<?= url('auth/login.php') ?>">Login</a><a class="btn btn-primary" href="<?= url('auth/register.php') ?>">Register</a>
          <?php }else{ ?>
          <a class="btn btn-light" href="<?= url('auth/logout.php') ?>">logout</a>
          <?php } ?>
        </div>
      </div>
    </header>