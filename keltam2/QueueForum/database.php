<?php
include('database_config.php');

$connection = new mysqli($server, $username, $password, $database);

if ($connection->connect_error) {
    die('Connection fail: ' . $connection->connect_error);
}
