<?php
    session_start();
    unset($_SESSION['error']);
    include "connector.php";
    $email = $_POST['email'];
    $password =$_POST['password'];
    $err = false;

    $result = $mysqli->query("SELECT email,`password` FROM `user` WHERE email = '$email' and `password` = '$password'");

    if($result->num_rows == 1){
        $_SESSION['email'] = $email;
        header("Location: ../index.php");
    }else if ($result->num_rows > 1){
        $_SESSION['error'] = 'SQL Injection detected';
        $err = true;
    }else{
        $_SESSION['error'] = 'Email / Password is incorrect';
        $err = true;
    }

    if($err){
        header("Location: ". $_SERVER['HTTP_REFERER']);
    }

?>