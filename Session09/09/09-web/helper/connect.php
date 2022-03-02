<?php
    $conn = mysqli_connect("localhost","root","","scrap");

    if($conn->errno){
        echo "Error connecting to database!";
        die();
    }

    return $conn;
?>