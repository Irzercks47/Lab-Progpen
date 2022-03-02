<?php
include('database.php');
include('helpers/session.php');
include('components/include.php');

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
    <title>My Discussions</title>
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="container content">
        <h3>My Discussion</h3>

        <?php
        $curr_user_id = $_SESSION['user_id'];
        $query = "SELECT d.id, title, name, date
             FROM discussions d
             JOIN users u
             ON d.user_id = u.id    
             WHERE u.id = $curr_user_id
             ORDER BY date DESC";
        $sql = $connection->query($query);

        while ($result = $sql->fetch_assoc()) {
            $id = $result['id'];
            $title = $result['title'];
            $name = $result['name'];
            $timestamp = strtotime($result['date']);
            $date = date('F d, Y', $timestamp);
        ?>
            <a href="discussion.php?discussion_id=<?= $id ?>" class="box-link">
                <div class="box">
                    <div class="box-body"><?= $title ?></div>
                    <div class="box-footer">
                        Opened at <?= $date ?>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>

    </div>


    <?php include('components/footer.php'); ?>
</body>

</html>