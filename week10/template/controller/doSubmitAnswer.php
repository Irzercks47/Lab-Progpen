<?php

    include_once '../util/Connect.php';
    include_once '../util/helper.php';

    session_start();
    if(isset($_POST)){
        $title = $_POST['title'];
        $id = $_POST['id'];
        if ($title == "") {
            header("Location: ../submitAssignment.php?id="+$id);
            $_SESSION['error-submit'] = "mo item selected";
            die();
        }
        else if ($title == "") {
            header("Location: ../submitAssignment.php?id=" + $id);
            $_SESSION['error-submit'] = "title must not empty";
            die();
        }else if($_FILES["file"]["name"] == ""){
            header("Location: ../submitAssignment.php?id=" + $id);
            $_SESSION['error-submit'] = "no file selected";
            die();
        }else{
            unset($_SESSION['error-submit']);
            $file_name = $title . "_" . date("Y_m_d_H_i_s");
            $extensions = explode(".", $_FILES['file']['name']);
            $extensions = end($extensions);
            $file_path = $file_name . '.' . $extensions;
            $student_id = $_SESSION['user']['id'];

            $query = "INSERT INTO answers VALUES(NULL, '$student_id', '$id', '$title', '$file_path')";
            if($con->query($query)){
            move_uploaded_file($_FILES['file']['tmp_name'], '../upload/' . $file_path);
                unset($_SESSION['error-submit']);
                header("Location: ../index.php");
                die();
            }else{
                header("Location: ../submitAssignment.php?id=" + $id);
                $_SESSION['error-submit'] = "Error Submit";
                die();
            }
        }
    }
