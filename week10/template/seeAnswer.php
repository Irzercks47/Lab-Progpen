<?php
include_once './util/helper.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
} else if ($_SESSION['user']['role'] != "student") {
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
        table,th,tr,td {
            border: 1px solid black;
        }
        td,th {
            padding: 10px;
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
            <li><a href="controller/doLogout.php">Log Out</a></li>
        </Ul>
    </div>

    <p><h2>Your Answers</h2></p>
    <p><h4>the last number is your latest answer</h4></p>
    <div>
        <table>
            <tr>
                <th>No</th>
                <th>title</th>
                <th>download link</th>
            </tr>
            <?php
            $num = 1;
            foreach (get_your_answer($_SESSION['user']['id'], $_GET['id']) as $task) : ?>
                <tr>
                    <td><?= $num++ ?></td>
                    <td><?= $task['title'] ?></td>
                    <td><a href="./upload/<?= $task['file_path'] ?>" download>Download</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>