<?php
    session_abort();
    session_reset();
    session_start();
    unset($_SESSION['email']);
    header("Location: ../index.php");
?>