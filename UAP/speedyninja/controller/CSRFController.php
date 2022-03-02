<?php

function generateToken(){
    $_SESSION["_TOKEN"] = generateRandom(16);
}

function getCSRF(){

    if(!isset($_SESSION["_TOKEN"])){
        generateToken();
    }
    
    return $_SESSION["_TOKEN"];
}

function generateRandom($size)
{
    return bin2hex(random_bytes($size));
}

?>

