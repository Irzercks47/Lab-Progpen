<?php

    include_once '../util/Connect.php';
    include_once '../util/helper.php';
    session_start();
    if(isset($_POST)){

        $title = $_POST['title'];
        $start_date = $_POST['start-date'];
        $start_time = $_POST['start-time'];
        $end_date = $_POST['end-date'];
        $end_time = $_POST['end-time'];

        if($title == ""){
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "title must not empty";
            die();
        } else if ($start_date == ""){
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "must choose start date";
            die();
        } else if ($start_time == ""){
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "must choose start time";
            die();
        } else if ($end_date == ""){
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "must choose end date";
            die();
        } else if ($end_time == "") {
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "must choose end time";
            die();
        } else if($_FILES["file"]["name"] == ""){
            header("Location: ../createAssignment.php");
            $_SESSION['error-create'] = "no file selected";
            die();
        }else{
            unset($_SESSION['error-create']);
            $start_date_time = convert_date_time($start_date, $start_time);
            $end_date_time = convert_date_time($end_date, $end_time);

            $file_name = $title . "_" . date("Y_m_d_H_i_s");
            $extensions = explode(".", $_FILES['file']['name']);
            $extensions = end($extensions);
            $file_path = $file_name . '.' . $extensions;

            $lecture_id = $_SESSION['user']['id'];
            $query = "INSERT INTO assignments VALUES(NULL, '$title', '$file_path', '$lecture_id', '$start_date_time', '$end_date_time')";
            
            $con->query($query);
            if($con->affected_rows > 0){
                if(!file_exists('../upload')) mkdir('../upload');
                move_uploaded_file($_FILES['file']['tmp_name'], '../upload/' . $file_path);
                header("Location: ../index.php");
                die();
            }else{
                header("Location: ../createAssignment.php");
                $_SESSION['error-create'] = "upload error";
                die();
            }
        }
        // array(5) { ["name"]=> string(26) "Oleh oleh Network 20-1.pdf" ["type"]=> string(15) "application/pdf" ["tmp_name"]=> string(24) "C:\xampp\tmp\phpE18D.tmp" ["error"]=> int(0) ["size"]=> int(259006) }

        // array(5) { ["title"]=> string(5) "Guguk" ["start-date"]=> string(10) "2021-12-31" ["start-time"]=> string(5) "17:41" ["end-date"]=> string(10) "2022-02-09" ["end-time"]=> string(5) "16:45" }
    }



