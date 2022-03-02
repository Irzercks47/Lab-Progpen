<?php
    include_once '../util/Connect.php';
    session_start();
    

    if(isset($_POST)){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $con->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

        if($result->num_rows > 0){
            unset($_SESSION['error']);
            $result = $result->fetch_assoc();
            $_SESSION['user'] = $result;
            header("Location: ../index.php");
            die();
        }else{
            $_SESSION['error'] = 'invalid username or password';
            header("Location: ../login.php");
            die();
        }
    }