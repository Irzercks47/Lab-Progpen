<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
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
                    <a class="nav-link" href="./about.php">About us</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <?php 
                    if(isset($_SESSION['email'])){
                        echo '<li class="nav-item">';
                        echo '    <a class="nav-link" href="./controller/logout.php">Logout</a>';
                        echo '</li>';
                    }else{
                        echo '<li class="nav-item">';
                        echo '    <a class="nav-link" href="./login.php">Login</a>';
                        echo '</li>';
                    }
                ?>
            </ul>
        </div>
    </nav>

    <div class="jumbotron">
        <img src="./assets/about.jpg" >
        <h1 class="about-title">Supporting orphans while bringing about sustainable change that reduces the need for orphanages</h1>
        <br>
        <p class="about-desc">For the past 20 years, Miracle Foundation has improved the lives of more than 15,000 vulnerable children and orphans in need and impacted more than 300 orphanages in India.</p>
        <br>
        <p class="about-desc">Our revolutionary Thrive Scale™ methodology is based on the UN Rights of the Child and leverages data and technology to give every child the chance to reach their full potential.</p>
        <br>
        <p class="about-desc">Miracle Foundation is an international nonprofit for children, headquartered in Austin, Texas with offices in New York City and New Delhi. The majority of work is conducted in India, the epicenter of the global orphan crisis. Our approach is rooted in years of on-the-ground experience, driven by a careful methodology and powered by a deep passion to improve the lives of children and give them a chance to grow up in a family.</p>
        <br>
        <p class="about-desc">We believe in collaboration as we know this work is bigger than any one organization. We are part of a global network of nonprofit organizations leading the worldwide movement to end the need for orphanages by 2040.</p>
    </div>

</body>
<link rel="stylesheet" href="./style/style.css">
</html>