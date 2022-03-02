<?php
    include './components/header.inc.php';
    include './components/navbar.inc.php';
    include './controller/CSRFController.php';
    include './controller/errorController.php';

    if(isset($_SESSION["USER"])){
        header("Location:./homepage.php");
    }


?>

<body>

    <!-- Login Form -->
    <div class="container-fluid h-100 bg-index">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3 bg-light">

                <form action="./controller/loginController.php" method="POST">

                    <!-- Title -->
                    <div class="form-group mt-3">
                        <p class="text-center"> <b> Welcome to Speedy Ninja... </b> </p>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <input class="form-control form-control-lg" placeholder="Email" name="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : "" ?>" type="text">
                    </div>

                    <br>

                    <!-- CSRF Token -->
                    <div class="form-group">
                        <input type="hidden" name="CSRFtoken" value="<?php echo getCSRF() ?>">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <input class="form-control form-control-lg" placeholder="Password" name="password" type="Password">
                    </div>

                    <br>

                    <!-- Error message -->
                    <?php
                        if(isset($_SESSION["ERROR"])){
                            echo '<div class="form-group text-center text-danger"> <p>' . $_SESSION["ERROR"] . ' </p></div>';
                        }
                    ?>

                    <!-- Button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark btn-lg btn-block" name="login">Login</button>
                    </div>

                    <br>

                </form>

            </div>
        </div>
    </div>
    <!-- Login Form -->

</body>

<?php
include './components/footer.inc.php';
?>

</html>