<?php

include './connect.php';

session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']) ? $_POST['remember_me'] : "off";

    // validate empty input
    $filled = true;

    if(empty($email)){
        $filled = false;
    }

    if(empty($password)){
        $filled = false;
    }

    if(!$filled){
        $_SESSION["ERROR"] = 'All input must be filled! Please try again.';
        header("Location:../index.php");
        die();
    }

    // get result from db
    $conn = getConnection();
    $query = "SELECT * FROM account WHERE email = '" . $email . "'";
    $result = $conn->query($query);

    $hashedpass = $result->fetch_assoc()['password'];
    $verify = password_verify($password, $hashedpass);

    if(!$verify){
        $verify = 0;
    }

    $query = "SELECT * FROM account WHERE email = '$email' AND (SELECT IF($verify, 1, 0)) = 1";

    $result = $conn->query($query);

    if($result = $conn->query($query)){

        if($result->num_rows != 1){
            $_SESSION["ERROR"] = 'Wrong credentials! Please try again.';
            header("Location:../index.php");
            die();
        }

        if(isset($_SESSION['_TOKEN']) && $_SESSION['_TOKEN'] !== $_POST['CSRFtoken']){
            $_SESSION["ERROR"] = 'Invalid CSRF Token!';
            header("Location:../index.php");
            die();
         }
        
        $_SESSION["USER"] = $result;
        header("Location:../homepage.php");
        
    }
    else {
        $_SESSION["ERROR"] = mysqli_error($conn);
        header("Location:../index.php");
        die();
    }

}


?>