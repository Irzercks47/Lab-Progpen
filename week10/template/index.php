<?php
include_once './util/helper.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
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
        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }

        td,
        th {
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
            <li><a href="/controller/doLogout.php">Log Out</a></li>
        </Ul>
    </div>
    <div>
        <p>Welcome, <?= $_SESSION['user']['username'] ?></p>
        <p>Your role is <?= $_SESSION['user']['role'] ?></p>
    </div>

    <?php if ($_SESSION['user']['role'] == "lecturer") :

        $own_task = getOwnTask($_SESSION['user']['id']);
    ?>
        <p>
        <h2>Your Student Submission</h2>
        </p>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Assignment</th>
                    <th>title</th>
                    <th>Student Name</th>
                    <th>download link</th>
                </tr>
                <?php
                $i = 1;
                foreach (get_student_answer($_SESSION['user']['id']) as $task) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $task['ASG_title'] ?></td>
                        <td><?= $task['title'] ?></td>
                        <td><?= $task['username'] ?></td>
                        <td><a href="./upload/<?= $task['file_path'] ?>" download>Download</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <p>
        <h2>Your Task</h2>
        </p>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>title</th>
                    <th>start date</th>
                    <th>end date</th>
                    <th>download link</th>
                </tr>
                <?php
                $j = 1;
                foreach (getOwnTask($_SESSION['user']['id']) as $task) : ?>
                    <tr>
                        <td><?= $j++ ?></td>
                        <td><?= $task['title'] ?></td>
                        <td><?= $task['start_date'] ?></td>
                        <td><?= $task['end_date'] ?></td>
                        <td><a href="./upload/<?= $task['file_path'] ?>" download>Download</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    <?php else : ?>
        <p>
        <h2>Your Task</h2>
        </p>
        <div>
            <table>
                <tr>
                    <th>title</th>
                    <th>Lecture</th>
                    <th>start date</th>
                    <th>end date</th>
                    <th>download link</th>
                    <th>submit</th>
                    <th>view answers</th>
                </tr>
                <?php foreach (getAllTask() as $task) : ?>
                    <tr>
                        <td><?= $task['title'] ?></td>
                        <td><?= $task['username'] ?></td>
                        <td><?= $task['start_date'] ?></td>
                        <td><?= $task['end_date'] ?></td>
                        <td><a href="./upload/<?= $task['file_path'] ?>" download>Download</a></td>
                        <td><a href="./submitAssignment.php/?id=<?= $task['id'] ?>">submit</a></td>
                        <td><a href="./seeAnswer.php?id=<?= $task['id'] ?>">view answers</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>

</body>

</html>