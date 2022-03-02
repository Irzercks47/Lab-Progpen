<?php
    $mysqli = new mysqli("localhost","root","","progpentest1011");
    
    if ($mysqli-> connect_errno){
        echo "Failed to connect to mysql";
        exit();
    }

    return $mysqli;

?>