<?php
session_start();
include ('dbconfig.php');
$var = $_SESSION['user_id'];

if(isset($_POST['btn_saveChangesAgent'])){
        $title = $_POST['title'];
        $stats = $_POST['stats'];
        $sf = $_POST['sf'];
        $ptype = $_POST['ptype'];
        $bed = $_POST['bed'];
        $basement = $_POST['basement'];
        $garage = $_POST['garage'];
        $location = $_POST['location'];
        $lot = $_POST['lot'];
        $area = $_POST['area'];
        $bath = $_POST['bath'];
        $price = $_POST['price'];
        $dp = $_FILES['propertyImg']['name'];

        $queryInsert = "INSERT INTO `tbl_property`(`agent_ID`, `title`, `location`, `propertyType`, `bedroom`, `bathroom`, `basement`, `garage`, `lotSize`, `floorArea`, `specialFeatures`, `price`, `statusProperty`) 
        VALUES ('$var','$title','$location','$ptype','$bed','$bath','$basement','$garage','$lot','$area','$sf','$price','$stats')";
        $resultInsert = mysqli_query($connect, $queryInsert);
        
        $query1 = "SELECT * from tbl_property WHERE title = '$title'";
        $result1 = mysqli_query($connect, $query1);
        $row1 = mysqli_fetch_assoc($result1);
        $var1 = $row1['property_ID'];

        $countfiles = count($dp);

        for($i=0;$i<$countfiles;$i++){
            $filename = addslashes(file_get_contents($_FILES['propertyImg']['tmp_name'][$i])) ?? "";
            $sqlUpload = "INSERT INTO tbl_show(property_ID, propertyImg, date_Time) 
            VALUES ('$var1','$filename',NOW())";
            $result = mysqli_query($connect, $sqlUpload);
        
        }

        
        if ($result) {
            ?>
            <script>
                alert('Successfully Add Property');
                location = 'editproperty.php';
                exit;
            </script>
            <?php }else{?>
            <script>
                alert('Adding Property Failed');
                location = 'editproperty.php';
                exit;
            </script>
            <?php
        }
        
  
    }
?>