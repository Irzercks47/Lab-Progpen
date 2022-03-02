<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "./controller/connector.php";
        session_start(); 

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <a class="navbar-brand" href="./index.php">
          <img src="./assets/miracle_fdn_logo.png" height="25" class="d-inline-block align-top" alt="" loading="lazy">
          Miracle Orphanage
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./donations.php">Donation</a>
                </li>
            </ul>
        </div>
    </nav>
        
    <?php
        $res = $mysqli->query("SELECT header_donation.header_id, donation_title, donation_date from 
        header_donation join detail_donation on
        header_donation.header_id = detail_donation.header_id
        ");
        for($i = 0 ; $i < $res->num_rows && $arr = $res->fetch_assoc(); $i++){
            $idx = $i + 1;
            echo '<div class="card card-container">';
            echo '<div class="card-header">';
            echo "<h5 class=\"card-title\"><a href=\"detail_donation.php?id=" . $arr['header_id'] ."\">" . $arr['donation_title'] . "</a></h5>";
            echo '</div>';
            echo '<div class="card-body" style="text-align:right;">';
            echo '<blockquote class="blockquote mb-0">';
            echo "Donated on " . $arr['donation_date'];
            echo '</blockquote>';
            echo '</div>';
            // echo '<div class="card-footer">';
            
            
            // echo '</div>';
            echo '</div>';

            
        }
    ?>
</body>
</html>