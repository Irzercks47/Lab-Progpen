<?php
include('../database.php');
include('../helpers/session.php');
include('../helpers/message.php');

$action = $_REQUEST['action'];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['csrf_token']) &&
    hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token'])
) {
    if ($action == 'login') {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $query = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password') LIMIT 1";
        $sql = $connection->query($query);
        if ($sql->num_rows === 1 && $result = $sql->fetch_assoc()) {
            $_SESSION['user_id'] = $result['id'];

            header('Location: ../index.php');
        } else {
            add_message('error', 'Incorect username or password');
            header('Location: ../login.php');
        }
        exit();
    } else if ($action == 'register') {
        $username = $_REQUEST['username'];
        $name = $_REQUEST['name'];
        $password = $_REQUEST['password'];
        $email = $_REQUEST['email'];

        if (!$username || !$name || !$password || !$email) {
            add_message('error', 'All fields must be filled');
            header('Location: ../register.php');
        } else {
            $query = "SELECT FROM users WHERE username='$username' LIMIT 1";
            $sql = $connection->query($query);

            if ($result = $sql->fetch_assoc()) {
                add_message('error', 'Username has already taken!');
                header('Location: ../register.php');
            } else {
                $query = "INSERT INTO users (username, name, password, email)
                        VALUES ('$username', '$name', SHA1('$password'), '$email')";
                $connection->query($query);

                add_message('success', 'Success register!');
                header('Location: ../register.php');
            }
        }
        exit();
    }
} else {
    if ($action == 'logout') session_destroy();
    header('Location: ../login.php');
    exit();
}

header('Location: ../login.php');
