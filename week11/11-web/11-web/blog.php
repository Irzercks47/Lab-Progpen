<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog of the Day</title>
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

    <div class="row row-cols-1 row-cols-md-3 blog">
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/1.jpeg" class="card-img-top">
                <div class="card-body">
                  <p class="card-text">We "save" more life that we could imagine. We are happy to know that we could help!</p>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/2.jpeg" class="card-img-top">
                <div class="card-body">
                <p class="card-text">Narul, "Changing a life one at a time". We glad we can "help" him to recover and reunite him with his families</p>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/3.jpeg" class="card-img-top">
                <div class="card-body">
                <p class="card-text">Daksh, a young boy with unlimited potential. We glad to "have" you Daskh!</p>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/4.jpeg" class="card-img-top">
                <div class="card-body">
                <p class="card-text">An afternoon with Sana, one of our greatest "coordinator" that "handled" children in our community! Such initiative and kindness!</p>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/5.jpeg" class="card-img-top">
                <div class="card-body">
                <p class="card-text">Here are our ambassadors of our community. We gave our children a "better" place to live!</p>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100" style="width: 25rem;">
                <img src="./assets/news/6.jpg" class="card-img-top">
                <div class="card-body">
                <p class="card-text">Caroline, one of our Coordinators tried to gain the children's trust! Transparency in our "program" make young children have hope to live for another day!</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>