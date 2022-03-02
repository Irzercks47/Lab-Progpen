<?php
include('../database.php');
include('../helpers/session.php');
include('../helpers/message.php');

$discussion_id = $_REQUEST['discussion_id'];
$user_id = $_SESSION['user_id'];

if (!$discussion_id || !$user_id) {
    header("Location: ../index.php");
    exit();
}

if (isset($_REQUEST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token'])) {
    $comment = $_REQUEST['comment'];

    if (!$comment) {
        add_message('error', 'Comment must be filled');
    } else {
        $query = "INSERT INTO comments (comment, discussion_id, user_id)
                VALUES ('$comment', $discussion_id, $user_id)";
        $connection->query($query);

        add_message('success', 'Success post comment');
    }

    header("Location: ../discussion.php?discussion_id=$discussion_id");
} else {
    header("Location: ../discussion.php?discussion_id=$discussion_id");
}
