<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

session_start();
$error = '';
global $pdo;

if(isset($_SESSION['users'])){
    unset($_SESSION['users']);
}

if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
) {

    $query = "SELECT * FROM php_project.users WHERE email = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['email']]);
    $user = $statement->fetch();

    if($user !== false){

        if(password_verify($_POST['password'], $user->password)){
            $_SESSION['users']= $user->email;
            redirect('admin');
        }
        else{
            $error = 'پسورد اشتباه است';
        }

    }
    else{
        $error = 'ایمیل وارد شده اشتباه است';
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Postify</title>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
</head>

<body>
    <main class="form-page">
        <section class="auth-card">
            <a href="<?= url('') ?>" class="auth-mark">P</a>
            <h1>Welcome Back</h1>
            <p>Log in to your account and continue exploring Postify.</p>
            <span style="color: red;">
                <?php
                if ($error !== '') {
                    echo $error;
                }
                ?>
            </span>
            <form action="<?= url('auth/login.php') ?>" method="post">
                <div class="form-group">
                    <label for="email">Email</label><input
                        class="input"
                        id="email"
                        type="email"
                        name="email"
                        placeholder="you@example.com"
                        required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label><input
                        class="input"
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required />
                </div>
                <button class="btn btn-primary form-submit" type="submit">
                    Login
                </button>
            </form>
            <div class="auth-footer">
                Don't have an account? <a href="<?= url('auth/register.php') ?>">Register</a>
            </div>
        </section>
    </main>
</body>

</html>