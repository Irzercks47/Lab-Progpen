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
    <title>Home</title>
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="container content">
        <h3>Open New Discussion</h3>

        <form action="manage/discussion.php" method="POST">
            <div class="logout-box">

                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="action" value="add">

                <div class="form-component">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>

                <div class="form-component">
                    <label for="topic">Topic</label>
                    <select class="form-control" name="topic" id="topic" 
                        onmousedown="if(this.options.length > 5){this.size = 5}" onblur="this.size = 0;" 
                        onchange="this.size = 0;">

                        <?php
                        $query = "SELECT * FROM topics";
                        $sql = $connection->query($query);

                        while ($result = $sql->fetch_assoc()) {
                            $id = $result['id'];
                            $name = $result['name'];
                        ?>
                            <option value="<?= $id ?>"><?= $name ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>

                <div class="form-component">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" placeholder="Content"></textarea>
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

                <button type="submit" class="form-btn">Open Discussion</button>
            </div>
        </form>

    </div>

    <?php include('components/footer.php'); ?>
</body>

</html>