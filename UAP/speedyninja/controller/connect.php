<?php

if (!function_exists('getConnection')){

    function getConnection(){

        $username = "root";
        $password = "";
        $database = "speedyNinja";
        $host = "localhost:3306";
        
        try {
            $conn = mysqli_connect($host, $username, $password,$database);
        } catch (Exception $e) {
            die("Connection failed: " + $e);
        }
        return $conn;
    }

}

?>
