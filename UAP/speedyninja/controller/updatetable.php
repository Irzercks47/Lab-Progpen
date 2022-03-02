<?php
include './connect.php';

    $conn = getConnection();
    $query = "SELECT password FROM account";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $password = $row['password'];
            $new_password = password_hash($password, PASSWORD_DEFAULT);

            $query2 = "UPDATE account SET password = '" . $new_password . "' WHERE password = '" . $password . "'";
            $conn->query($query2);
            echo $query2;
        }
        
    }

?>

