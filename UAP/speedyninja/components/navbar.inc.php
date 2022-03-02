<?php
    session_start();
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div>
            <div>
                <div class="p-2 d-flex">
                    <a href="./homepage.php"><img src="./assets/logo.png" alt="a" class="p-1 mt-2 mx-1" style="width: 45px; height: 45px;"></a>
                    <h1 class="mt-1"> Speedy Ninja!</h1>
                </div>
                <h4 class="mx-3">Reliable Delivery Service in Town</h4>
            </div>
        </div>
        
        <!-- Button -->
        <div class="d-flex align-items-center">
            <?php
                if(isset($_SESSION["USER"])){
            ?>
                <a href="./controller/logoutController.php" class="btn btn-dark btn-theme me-3"> Logout </a>
            <?php
                }
            ?>
        </div>
    </div>
</nav>