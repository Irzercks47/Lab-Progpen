<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "./controller/connector.php";
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation</title>
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
                    <a class="nav-link" href="./index.php">Home<span class="sr-only">(current)</span></a>
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

    <!-- <div class="jumbotron" style="background-color: #fff;position:relative;"> -->
        <?php
            $id = $_GET['id'];
            $query = "SELECT donation_title,donation_description,donation_date,donation_value,destination_image,destination_name
            FROM header_donation JOIN detail_donation on header_donation.header_id = detail_donation.header_id
            JOIN destination ON destination.destination_id = detail_donation.destination_id
            WHERE header_donation.header_id = $id;
            ";
            $res = $mysqli->query($query);
            $data = $res->fetch_array();
            // var_dump($query);
            // var_dump($data);
            // echo '<h1>';
            // echo $data[0];
            // echo '</h1>';
            // echo '<p>';
            // echo $data[1];
            // echo '</p>';
            // echo '<p style="text-align:left;word-wrap:break-word;">';
            // echo "This person donate " . $data[3] . "$";
            // echo '</p>';
            // echo '<p style="text-align:right;position:absolute;bottom:0;right:0;padding:0 4vw;">';
            // echo "This donation is registered on " . $data[2];
            // echo '</p>';

            // echo '<div class="row">';
            // echo '    <div class="col-6 mb-2">';
            // echo '        <div class="card">';
            // echo '            <div class="card-body">';
            // echo "                <img src=\"./assets/destination/" . $data[4] . "\" class=\"card-img-top\" style=\"width=50vw;\">";
            // echo '            </div>';
            // echo '            <div class="card-footer">';
            // echo '                <small class="text-muted">This is donated to Miracle Orphanage at ' . $data[5] . '</small>';
            // echo '            </div>';
            // echo '        </div>';
            // echo '    </div>';
            // echo '    <div class="col-6 mb-2">';
            // echo '        <div class="card">';
            // echo '        <div class="card-body">';
            // echo '            <h1 class="card-title" style="text-align:left;">' . $data[0].  ' </h1>';
            // echo '            <p class="card-text">' . $data[1] .  ' </p>';
            // echo '            <h3 class="card-title" style="text-align:left;">This person donated ' . $data[3].  '$</h1>';
            // echo '        </div>';
            // echo '        <div class="card-footer">';
            // echo '            <small class="text-muted">This donation is registered on ' . $data[2] .  '</small>';
            // echo '        </div>';
            // echo '    </div>';
            // echo '</div>';
            
        ?>
        <div class="row w-100" style="display:flex; justify-content: center;margin-left:0;margin-right:0;">
            <div class="col-6">
                <?php
                    echo "<img src=\"./assets/destination/" . $data[4] . "\" class=\"card-img-top\">";
                    echo '            <div class="card-footer">';
                    echo '                <small class="text-muted">This is donated to Miracle Orphanage at ' . $data[5] . '</small>';
                    echo '            </div>';
                ?>
            </div>
            <div class="col-6">
                <?php
                    echo '        <div class="card">';
                    echo '        <div class="card-body">';
                    echo '            <h1 class="card-title" style="text-align:left;">' . $data[0].  ' </h1>';
                    echo '            <p class="card-text">' . $data[1] .  ' </p>';
                    echo '            <h3 class="card-title" style="text-align:left;">This person donated ' . $data[3].  '$</h1>';
                    echo '        </div>';
                    echo '        <div class="card-footer">';
                    echo '            <small class="text-muted">This donation is registered on ' . $data[2] .  '</small>';
                    echo '        </div>';
                ?>
            </div>
        </div>
    <!-- </div> -->

</body>
</html>