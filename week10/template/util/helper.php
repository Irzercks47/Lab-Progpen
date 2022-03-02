<?php

    include_once 'Connect.php';

    function convert_date_time($date, $time)
    {
        $start_date_milis = strtotime($date);
        $start_hour = intval(explode(":", $time)[0]);
        $start_minutes = intval(explode(":", $time)[1]);
        $start_date_milis  += $start_hour * 3600 + $start_minutes * 60;
        return date("Y-m-d H:i:s", $start_date_milis);
    }

    function get_your_answer($student_id, $assignment_id){
        global $con;
        $query = "SELECT * FROM answers WHERE student_id = '$student_id' AND assignment_id = '$assignment_id' ORDER BY id DESC";
        $result = $con->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) array_push($tasks, $row);
        return $tasks;
    }

    function get_student_answer($lecture_id){
        global $con;
        $query = "SELECT ANS.id, U.username, ANS.title, ANS.file_path, ASG.title as 'ASG_title' FROM answers ANS join assignments ASG on ANS.assignment_id = ASG.id join users U on U.id = ANS.student_id WHERE ASG.lecture_id = '$lecture_id'";
        $result = $con->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) array_push($tasks, $row);
        return $tasks;
    }

    function getOwnTask($lecture_id){
        global $con;
        $query = "SELECT * FROM assignments WHERE lecture_id = '$lecture_id'";
        $result = $con->query($query);
        $tasks = [];
        while ($row = $result->fetch_assoc()) array_push($tasks, $row);
        return $tasks;
    }

    function getAllTask(){
        global $con;
        $query = "SELECT ASG.id, ASG.title, ASG.file_path, ASG.start_date, ASG.end_date, L.username FROM assignments ASG join users L on L.id = ASG.lecture_id AND NOW() BETWEEN ASG.start_date AND ASG.end_date";
        $result = $con->query($query);
        $tasks = [];
        while($row = $result->fetch_assoc()) array_push($tasks, $row);
        return $tasks;
    }