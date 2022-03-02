<?php
    function get_token(){
        if(!session_has_token())
            regenerate_token();
        return $_SESSION['csrf_token'];
    }

    function regenerate_token(){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(64));
    }

    function session_has_token(){
        return isset($_SESSION['csrf_token']);
    }
    
    if(!session_has_token())
        regenerate_token();
?>