<?php

    $con = new mysqli("localhost:3306", "root", "", "course_management");
    if($con->error){
        die('failed to connect');
    }