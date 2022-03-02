<?php
include('helpers/session.php');
include('components/include.php');
include('helpers/message.php');

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body class="login-bg">
    <?php include('components/header.php'); ?>

    <form action="auth/auth.php" method="POST">
        <div class="register-box">
            <h3>Register</h3>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="action" value="register">

            <div class="form-component">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>

            <div class="form-component">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
            </div>

            <div class="form-component">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-component">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <?php
            $class = '';
            $type = get_message_type();
            if ($type == 'error')
                $class = 'alert alert-danger';
            else if ($type == 'success')
                $class = 'alert alert-success';
            ?>
            <div class="<?= $class ?>">
                <?= get_message() ?>
            </div>

            <button type="submit" class="form-btn">Register</button>
        </div>
    </form>

    <?php include('components/footer.php'); ?>
</body>

</html>