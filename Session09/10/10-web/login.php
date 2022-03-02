<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start(); 
        if(isset($_SESSION['email'])){
            if(isset($_SERVER['HTTP_REFERER'])){
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }else{
                header("Location: ./index.php");
            }
        }
    
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="./register.php">Register</a>
                </li> -->
            </ul>
        </div>
    </nav>

    <form class="form-signin" action="controller/login_user.php" method="POST">
        <div class="text-center mb-4">
            <h1 class="h3 mt-4 mb-3 font-weight-normal">Login</h1>
        </div>
        
        <div class="form-label-group">
            <label for="inputEmail">Email address</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>
        
        <div class="form-label-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        </div>

        <?php require "./controller/csrf.php"; ?>
        <input type="hidden" name="token" value="<?= get_token() ?>">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

    <?php
        if(isset($_SESSION['error'])){
            echo '<div class="alert alert-danger alert-container" role="alert">';
            echo $_SESSION['error'];
            echo '</div>';
        }
    ?>

    <p class="mt-5 mb-3 text-muted text-center">&copy; 2020 - 19-1</p>
</body>
</html>