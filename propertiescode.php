<?php

session_start();
include ('dbconfig.php');

if(isset($_POST["btn_hide1"])){
    $user= $_POST['user'];
    $agent = $_POST['agent'];
    $property = $_POST['property'];

    $query = "INSERT INTO `tbl_transaction`(`agent_ID`, `user_ID`, `property_ID`, `trans_Date`, `status_Trans`) 
    VALUES ('$agent','$user','$property',NOW(),'Pending')";
    $result = mysqli_query($connect, $query);

    $query = "UPDATE `tbl_property` SET `statusProperty`='Pending' WHERE property_ID = '$property'";
    $result = mysqli_query($connect, $query);

    if (isset($result)) {
        ?>
        <script>
            alert('Transaction Success, wait for the agent to confirm');
            location = 'properties.php';
            exit;
        </script>
        <?php }else{?>
        <script>
            alert('Transaction Failed');
            location = 'properties.php';
            exit;
        </script>
        <?php
    }   
}

?>