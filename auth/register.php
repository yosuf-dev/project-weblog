<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';


$error = '';
global $pdo;

if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['first_name']) && $_POST['first_name'] !== ''
    && isset($_POST['last_name']) && $_POST['last_name'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
    && isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {

    if ($_POST['password'] === $_POST['confirm']) {
        if (strlen($_POST['password']) > 5) {
            $query = "SELECT * FROM php_project.users WHERE email = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if ($user == false) {

                $query = "INSERT INTO php_project.users SET email= ? , first_name= ?, last_name = ?, password = ?, created_at = NOW();";
                $statement = $pdo->prepare($query);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $statement->execute([$_POST['email'], $_POST['first_name'], $_POST['last_name'], $password]);
                redirect('auth/login.php');
            } else {
                $error = 'شما قبلا با این ایمیل حساب داشتید!';
            }
        } else {
            $error = 'مقدار پسورد باید حداقل پنج کاراکتر باشد!';
        }
    } else {
        $error = 'مقدار پسورد با تاییده ی آن برابر نیست!';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register — Postify</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="auth-card register-card">
            <a href="<?= url('') ?>" class="auth-mark">P</a>
            <h1>Create Account</h1>
            <p>Create your account and start exploring Postify.</p>
            <span style="color: red;">
                <?php
                if ($error !== '') {
                    echo $error;
                }
                ?>
            </span>
            <form action="<?= url('auth/register.php') ?>" method="post">
                <div class="form-group">
                    <label for="reg-email">Email</label><input
                        class="input"
                        id="reg-email"
                        type="email"
                        placeholder="you@example.com"
                        name="email"
                        required />
                </div>
                <div class="form-group">
                    <label for="name">First Name</label><input
                        class="input"
                        id="name"
                        type="text"
                        placeholder="Your First Name"
                        name="first_name"
                        required />
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label><input
                        class="input"
                        id="name"
                        type="text"
                        placeholder="Your Last Name"
                        name="last_name"
                        required />
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label><input
                        class="input"
                        id="reg-password"
                        type="password"
                        placeholder="Create a password"
                        name="password"
                        required />
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label><input
                        class="input"
                        id="confirm-password"
                        type="password"
                        placeholder="Repeat your password"
                        name="confirm"
                        required />
                </div>
                <button class="btn btn-primary form-submit" type="submit">
                    Register
                </button>
            </form>
            <div class="auth-footer">
                Already have an account? <a href="<?= url('auth/login.php') ?>">Login</a>
            </div>
        </section>
    </main>
</body>

</html>