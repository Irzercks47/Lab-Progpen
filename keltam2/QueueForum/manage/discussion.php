<?php
include('../database.php');
include('../helpers/session.php');
include('../helpers/message.php');

$action = $_REQUEST['action'];
$user_id = $_SESSION['user_id'];

if (!$action || !$user_id) {
    header("Location: ../index.php");
    exit();
}

if (isset($_REQUEST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token'])) {
    $content = $_REQUEST['content'];

    if ($action == 'add') {
        $title = $_REQUEST['title'];
        $topic_id = $_REQUEST['topic'];

        if (!$title || !$content || !$topic_id) {
            add_message('error', 'All fields must be filled');
        } else {
            $query = "INSERT INTO discussions (title, content, topic_id, user_id)
                    VALUES ('$title', '$content', $topic_id, $user_id)";
            $connection->query($query) or die($query);

            add_message('success', 'The discussion is opened');
        }

        header('Location: ../opendiscussion.php');
    } else if ($action == 'edit') {
        $discussion_id = $_REQUEST['discussion_id'];

        if (!$content) {
            add_message('error', 'Content must be filled');
        } else {
            $query = "UPDATE discussions SET content = '$content'
                     WHERE id = $discussion_id AND user_id = $user_id";
            $connection->query($query);
        }

        header("Location: ../discussion.php?discussion_id=$discussion_id");
    } else {
        header('Location: ../index.php');   
    }
} else {
    header('Location: ../index.php');
}
