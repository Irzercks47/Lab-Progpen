<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start(); 
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miracle Foundation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
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

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li style="color:black" data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li style="color:black"  data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li style="color:black"  data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner ">
          <div class="carousel-item active">
            <img src="./assets/1.jpg" class="d-block" style="width: 81.6%; margin: 0 auto;">
            <div class="carousel-caption d-none d-md-block">
                <h5>15000 children's live improved</h5>
                <p>Over 15000 children that has a "new" life</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/2.jpg" class="d-block" style="width: 81.6%; margin: 0 auto;">
            <div class="carousel-caption d-none d-md-block">
                <h5>2300 Government workers and childcare</h5>
                <p>There more than 2300 workers that are trained to "handle" our children</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/3.jpg" class="d-block" style="width: 81.6%; margin: 0 auto;">
            <div class="carousel-caption d-none d-md-block">
                <h5>20% children reunited with families</h5>
                <p>There are 20% of all our children has "reunited" with their families</p>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>