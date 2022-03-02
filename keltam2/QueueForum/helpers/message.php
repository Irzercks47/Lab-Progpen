<?php
function add_message($type, $message)
{
    $_SESSION['message_type'] = $type;
    $_SESSION['message'] = $message;
}

function get_message_type()
{
    $temp = '';
    if (isset($_SESSION['message_type'])) {
        $temp = $_SESSION['message_type'];
        $_SESSION['message_type'] = '';
    }

    return $temp;
}

function get_message()
{
    $temp = '';
    if (isset($_SESSION['message'])) {
        $temp = $_SESSION['message'];
        $_SESSION['message'] = '';
    }

    return $temp;
}
