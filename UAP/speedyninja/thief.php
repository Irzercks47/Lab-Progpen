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
    
    <div class="container-fluid bg-thief">

    <div class="container d-flex flex-column">
    <?php

        $id  = $_GET["id"];

        $conn = getConnection();
        $query = 'SELECT * FROM thiefType where thiefTypeId = ' . $id;
    
        if($result = $conn->query($query)){

            $data = $result->fetch_assoc();

            $thiefTypeId = $data["thiefTypeId"];
            $thiefTypeName = $data["thiefTypeName"];
            $thiefTypeDesc = $data["thiefTypeDesc"];
            $thiefTypePrice = $data["thiefTypePrice"];
    ?>

            <!-- Thief Type Info -->
            <div class="container mt-5 d-flex">

                <!-- image -->
                <div class="container w-75 p-0">
                    <?php echo '<img src="./assets/ninja-' . $thiefTypeId . '.jpg" alt="" srcset="" style="max-width:100%;">' ?>
                </div>

                <!-- info -->
                <div class="container p-3 bg-light">
                    <div class="form-group"><h3> Ninja Type: <?php echo $thiefTypeName ?> </h3></div>
                    <div class="form-group"><h6> Price: IDR <?php echo $thiefTypePrice ?> </h6></div>
                    <div class="form-group"><p> Detail: <?php echo $thiefTypeDesc ?> </p></div>
                </div>
            </div>

    <?php
            $query2 = 'SELECT * FROM thief WHERE thiefTypeId = ' . $thiefTypeId . ' ';

            if($result2 = $conn->query($query2)){

    ?>
            <!-- Thief list -->
            <div class="container p-4 float-md-left mt-2 mx-2">
    <?php
                while($row = $result2->fetch_assoc()){
                    $thiefCodeName = $row["thiefCodeName"];
                    $thiefAge = $row["thiefAge"];
                    $yearsOfExperience = $row["yearsOfExperience"];
                    echo '<a href="" style="text-decoration:none"><div class="form-group mt-3 p-2 thief-div"><h5>' . $thiefCodeName .' | Age: ' . $thiefAge . ' | Years of Experience: ' . $yearsOfExperience . ' years</h5></div></a>';
                }
            }
            else {
                echo '<div class="bg-danger text-light"> error. ' . mysqli_error($conn) . '</div>';
            }
    ?>
            </div>

    <?php

        }
        else {
            echo '<div class="bg-danger text-light"> error. ' . mysqli_error($conn) . '</div>';
        }

    ?>

    </div>
    </div>

</body>

<?php
include './components/footer.inc.php';
?>

</html>
