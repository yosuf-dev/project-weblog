<?php require_once '../functions/helpers.php';
require_once '../functions/check-login.php'; ?>

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
        <?php require_once './layouts/sidbar.php'; ?>
        <div class="main-area">
            <?php require_once './layouts/nav-top.php'; ?>
            <main class="content">
                <section class="welcome-card">
                    <h1>Welcome back 👋</h1>
                    <p>
                        Welcome to the AdminSpace Admin Panel. Manage your categories and
                        posts from one simple dashboard.
                    </p>
                </section>
            </main>
        </div>
    </div>
</body>

</html>