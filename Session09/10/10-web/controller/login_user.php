<?php
    session_start();
    unset($_SESSION['error']);
    include "./connector.php";
    include "./csrf.php";
    $email = $_POST['email'];
    $password =$_POST['password'];
    $err = false;
    $token = $_POST['token'];

    if(get_token() !== $token) {
        $_SESSION["error"] = "Error: Possible CSRF attack attempt!";
        die(header("Location: ./../login.php"));
    }

    $result = $mysqli->query("SELECT email,`password` FROM `user` WHERE email = '$email' and `password` = '$password'");
    
    if($result->num_rows == 1){
        session_regenerate_id(true);
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
        header("Location: ./../login.php");
    }

?>