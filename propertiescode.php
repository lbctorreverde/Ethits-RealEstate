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

    if (isset($result)) {
        ?>
        <script>
            alert('Successfully Update');
            location = 'properties.php';
            exit;
        </script>
        <?php }else{?>
        <script>
            alert('Updating Failed');
            location = 'properties.php';
            exit;
        </script>
        <?php
    }   
}

?>