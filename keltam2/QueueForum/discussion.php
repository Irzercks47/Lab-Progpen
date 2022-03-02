<?php
include('database.php');
include('helpers/session.php');
include('components/include.php');
include('helpers/message.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion</title>
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="container content">
        <?php
        $discussion_id = $_REQUEST['discussion_id'];
        $query = "SELECT d.id as id, title, content, u.name as user_name,
             t.name as topic, date, u.id as user_id
             FROM discussions d
             JOIN users u
             ON d.user_id = u.id
             JOIN topics t
             ON d.topic_id = t.id
             WHERE d.id = $discussion_id";
        $sql = $connection->query($query);

        if (!$sql) http_response_code(500);
        else {
            if ($sql->num_rows == 0) {
        ?>
                <div class="box">
                    <div class="box-footer">
                        Discussion not found
                    </div>
                </div>
            <?php
            } else {
                if ($result = $sql->fetch_assoc()) {
                    $id = $result['id'];
                    $timestamp = strtotime($result['date']);
                    $date = date('F d, Y', $timestamp);

                    $discussion = [
                        'id' => $id,
                        'title' => $result['title'],
                        'content' => $result['content'],
                        'user_id' => $result['user_id'],
                        'user_name' => $result['user_name'],
                        'topic' => $result['topic'],
                        'date' => $date
                    ];

                    $query = "SELECT c.id as id, u.name as user_name, comment
                         FROM comments c
                         JOIN users u
                         ON c.user_id = u.id
                         WHERE c.discussion_id = $id
                         ORDER BY c.id ASC";
                    $comment_sql = $connection->query($query);
                    $comments = [];

                    while ($comment_result = $comment_sql->fetch_assoc()) {
                        $comments[] = [
                            'id' => $comment_result['id'],
                            'user_name' => $comment_result['user_name'],
                            'comment' => $comment_result['comment']
                        ];
                    }
                }
            ?>
                <h3><?= $discussion['title'] ?></h3>

                <div class="box">
                    <div class="box-body"><?= nl2br($discussion['content']) ?></div>
                    <div class="box-body">
                        <small>By <b class="text-blue"><?= $discussion['user_name'] ?></b>
                            at <?= $discussion['date'] ?></small>
                        <?php
                        if ($discussion['user_id'] == $_SESSION['user_id']) {
                        ?>
                            <a href="editdiscussion.php?discussion_id=<?= $discussion['id'] ?>" class="edit-btn">
                                Edit Content
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="box-topic">
                        <span>Topic</span>
                        <span><?= $discussion['topic'] ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if (count($comments) == 0) {
                        ?>
                            <div class="comment-box">
                                <div class="comment-box-footer">
                                    <b class="text-blue">No comments for this discussion</b>
                                </div>
                            </div>
                            <?php
                        } else {
                            foreach ($comments as $comment) {
                            ?>
                                <div class="comment-box">
                                    <div class="comment-box-body">
                                        <?= nl2br($comment['comment']) ?>
                                    </div>
                                    <div class="comment-box-footer">
                                        Comment by <b class="text-blue"><?= $comment['user_name'] ?></b>
                                    </div>
                                </div>
                        <?php

                            }
                        }
                        ?>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="comment-box">
                            <div class="comment-box-body">
                                <form action="manage/comment.php" method="post">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="discussion_id" value="<?= $discussion['id'] ?>">

                                    <div class="form-component">
                                        <textarea type="text" class="form-control" name="comment" placeholder="Write your comment"></textarea>
                                    </div>

                                    <?php
                                    $class = '';
                                    $type = get_message_type();
                                    if ($type == 'error')
                                        $class = 'alert alert-danger';
                                    else if ($type == 'success')
                                        $class = 'alert alert-success';
                                    ?>
                                    <div class="<?= $class ?>">
                                        <?= get_message() ?>
                                    </div>

                                    <button type="submit" class="form-btn">Post comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>

    <?php include('components/footer.php'); ?>
</body>

</html>