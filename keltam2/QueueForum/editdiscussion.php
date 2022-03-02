<?php
include('database.php');
include('helpers/session.php');
include('components/include.php');
include('helpers/message.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$discussion_id = $_REQUEST['discussion_id'];
$query = "SELECT d.id as id, content
         FROM discussions d
WHERE d.id = $discussion_id AND user_id = {$_SESSION['user_id']}";
$sql = $connection->query($query);

if ($result = $sql->fetch_assoc()) {
    $content = $result['content'];
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="container content">
        <h3>Edit Discussion</h3>

        <form action="manage/discussion.php" method="POST">
            <div class="logout-box">

                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="discussion_id" value="<?= $discussion_id ?>">

                <div class="form-component">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" placeholder="Content"><?= htmlspecialchars($content) ?></textarea>
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

                <button type="submit" class="form-btn">Update Discussion</button>
            </div>
        </form>

    </div>

    <?php include('components/footer.php'); ?>
</body>

</html>