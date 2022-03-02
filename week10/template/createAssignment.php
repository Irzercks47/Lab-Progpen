<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
} else if ($_SESSION['user']['role'] != "lecturer") {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>

    <style>
        form>div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        form>div>textarea {
            width: 300px;
            height: 200px;
        }

        form>div>label {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div>
        <Ul style="display: flex; justify-content: space-evenly; list-style: none;">
            <li><a href="index.php">Home</a></li>
            <?php if ($_SESSION['user']['role'] == "lecturer") : ?>
                <li><a href="createAssignment.php">Create Assignment</a></li>
            <?php else : ?>
            <?php endif; ?>
            <li><a href="/controller/doLogout.php">Log Out</a></li>
        </Ul>
    </div>

    <p>
    <h2>Create Assigment</h2>
    </p>
    <form action="controller/doCreateAssignment.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" title>
        </div>
        <div>
            <label for="file">Start Date</label>
            <input type="date" name="start-date" id="start-date" style="margin-right: 10px;">
            <input type="time" name="start-time" id="start-time">
        </div>
        <div>
            <label for="file">End Date</label>
            <input type="date" name="end-date" id="end-date" style="margin-right: 10px;">
            <input type="time" name="end-time" id="end-time">
        </div>
        <div>
            <label for="file">File</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <?php if (isset($_SESSION['error-create'])) : ?>
                <p style="color: red;"><?= $_SESSION['error-create'] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <button>Create Assignment</button>
        </div>
    </div>

</body>

</html>