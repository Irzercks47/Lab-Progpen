<?php
    include "connector.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(strcmp($password,$cpassword) == 0){
            $hash = password_hash($password,PASSWORD_BCRYPT);
            $res = $mysqli->prepare("INSERT INTO `user` VALUES (null,?,?)");
            $res->bind_param("ss",$email,$hash);
            $success = $res->execute();
            if($success){
                header("Location:/register.php");
            }else{
                //balikin error
                echo "asdasd";
            }
        }
        else{
            //balikin error password gak sama
            echo "hello";
        }
    }
    else{
        //balikin error email
        echo "email error";
    }
?>