<?php
    include './components/header.inc.php';
    include './components/navbar.inc.php';
    include './controller/connect.php';
    include './controller/errorController.php';

    if(!isset($_SESSION["USER"])){
        header("Location:./index.php");
    }

?>

<body>
    
    <div class="container-fluid bg-homepage">
        <div class="container-fluid d-flex flex-column p-3">

            <!-- About Us -->
            <div class="container-fluid mt-4 p-1 bg-light text-center">
                <h3>About Us</h3>
                <p style="font-size:x-large">SpeedyNinja is a delivery service in to<b>w</b>n. With th<b>e</b> reli<b>a</b>ble team of cou<b>r</b>i<b>e</b>rs a<b>n</b>d del<b>i</b>very drivers, we provide you with a<b>n</b>y kind of service. You can <b>j</b>ust sit and rel<b>a</b>x, we can deliver any package of any size! Our courier service specializes in rush deliveries. You can ge<b>t</b> your package delivered anyw<b>h</b>ere throughout the c<b>i</b>ty fastly. You don't hav<b>e</b> to <b>f</b>eel troubled about the price because we provide you with several type of service in various price<b>.</b> </p>
            </div>
            
            <!-- Choose Your Service -->
            <div class="container-fluid mt-4 p-1 bg-light text-center">
                <h3>Choose Your Service</h3>
            </div>

            <!-- Thief Type Data -->
            <div class="container-fluid d-flex">
                <?php
                    $conn = getConnection();
                    $query = 'SELECT * FROM thiefType';
                    $result = $conn->query($query);

                    if(!$result){
                        echo mysqli_error($conn);
                    }
                    else{

                        while($row = $result->fetch_assoc()){
                ?>          
                            <div class="container w-25 p-3 float-md-left mt-4 mx-2 bg-light">
                                <?php
                                    $thiefTypeId = $row["thiefTypeId"];
                                    $thiefTypeName = $row["thiefTypeName"];
                                    $thiefTypeDesc = $row["thiefTypeDesc"];
                                    $thiefTypePrice = $row["thiefTypePrice"];
                                ?>

                                <img src="./assets/ninja-<?php echo $thiefTypeId?>.jpg" style="max-width:100%">
                                <div class="form-group"><h3> <?php echo $thiefTypeName?> </h3></div>

                                <div class="form-group">
                                    <form action="./thief.php" method="get">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block" name="id" value= <?php echo $thiefTypeId ?>>Check Service</button>
                                    </form>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
            
            </div>
        </div>
    </div>

</body>

<?php
include './components/footer.inc.php';
?>

</html>