<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    die();
}

function csrfToken(){
    $token = "";
    $token = bin2hex(random_bytes(32));
    return $token;   
}

if(empty($_SESSION["token"])){
    $_SESSION["token"] = csrfToken();
}else{
    $_SESSION["token"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
</head>

<body>

    <p>
    <h2>Course Management</h2>
    </p>
    <form action="./controller/doLogin.php" method="POST">
        <label for="">Username</label>
        <input type="hidden" name="CSRF_TOKEN" value="<?= $_SESSION["token"]; ?>">
        <input type="text" name="username" id="username">
        <br><br>
        <label for="">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <?php
        if (isset($_SESSION['error'])) : ?>
            <p style="color: red;"><?= $_SESSION['error'] ?></p>
        <?php else : ?>
            <br>
        <?php endif; ?>
        <input type="submit" name="action" value="Login">
    </form>

</body>

</html>