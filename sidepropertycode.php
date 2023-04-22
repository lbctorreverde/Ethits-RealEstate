
<?php
session_start();
include('dbconfig.php');

if(isset($_POST['page'])){ 
    // Include pagination library file 
    include_once 'Pagination.class.php'; 
    $var = $_SESSION['user_ID'];
    // Include database configuration file 

    $style = $_POST['styleBy'];
    // Set some useful configuration 
    $baseURL = 'sidepropertycode.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 6; 
     
    //Set conditions for search 
    $whereSQL = ''; 
    $orderSQL = ''; 
    if(!empty($_POST['keywords'])){ 
        $whereSQL = " WHERE (title LIKE '%".$_POST['keywords']."%' OR location LIKE '%".$_POST['keywords']."%' OR propertyType LIKE '%".$_POST['keywords']."%' OR statusProperty LIKE '%".$_POST['keywords']."%')"; 
    }

    if(strval($style) == 'null'){
        $style = '';
    }elseif($style == 'All'){ 
        $orderSQL = 'ORDER BY property_ID DESC'; 
    }
    elseif($style != 'All'){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " statusProperty='$style'"; 
    }

    $and = 'WHERE';

    if($whereSQL != ''){
        $and = 'AND';
    }
    // if($_POST['filterBy'] != null){ 
    //     $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
    //     $whereSQL .= " location LIKE '%".$_POST['filterBy']."%'"; 
    // }
    // Count of all records 
    $query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_property ".$whereSQL." $and agent_ID ='$var' "); 
    $result  = $query->fetch_assoc(); 
    $rowCount= $result['rowNum']; 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'result', 
        'link_func' => 'searchProperty' 
    ); 
    $pagination =  new Pagination($pagConfig);
    // Fetch records based on the offset and limit 
    $query = $connect->query("SELECT * FROM tbl_property " .$whereSQL." $and agent_ID ='$var'  $orderSQL LIMIT $offset,$limit");
?> 
    <!-- Data list container --> 
    <?php
        if($query->num_rows > 0){ $i=0; 
        $classadd = 0;
        while($row = $query->fetch_assoc()){?>
            <div class="loopbox">
                <div>
                    <?php
                        $var1 = $row['property_ID'];
                        $picShow = $connect->query("SELECT * FROM tbl_show WHERE property_ID = '$var1' LIMIT 1");
                        $rowShow = $picShow->fetch_assoc();
                        if (isset($rowShow['propertyImg'])) {
                            echo '<img  src="data:image/jpeg;base64,' . base64_encode($rowShow['propertyImg']) . '" id="picImg" style="border-radius:10px" class="d-block w-100" alt="First slide">';
                        } else {
                        ?>
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="360" height="200">
                        <?php
                        }
                    ?>
                </div>
                <div class="loopmid">
                    <blockquote class="blockquote">
                        <div class="looptitle">
                            <div style="font-family:'Open Sans', sans-serif; font-weight:1000; "><?=$row['title']?></div>
                            <?php if ($row['statusProperty'] == "Active") {?>
                                <div style="font-weight:700; color:green;"><?=$row['statusProperty']?></div>
                            <?php }else{?>
                                <div style="font-weight:700; color:red;"><?=$row['statusProperty']?></div>
                            <?php }?>
                        </div>
                        <footer class="blockquote-footer" style="transform: translate(0,14px); font-size:15px;">
                            <b>Price: ₱ <?=number_format($row['price']);?></b>
                        </footer>
                    </blockquote>
                    <div style="font-size: 15px; font-weight: 300;">
                        &nbsp;Style&nbsp;<?=$row['propertyType'];?>&nbsp;<i style="font-size:8px; transform: translate(0,-2px); color:#3b85c4;" class='bx bxs-circle'></i>
                        &nbsp;Bathroom&nbsp;<?=$row['bathroom'];?>&nbsp;<i style="font-size:8px; transform: translate(0,-2px); color:#3b85c4;" class='bx bxs-circle'></i>
                        &nbsp;Bedroom&nbsp;<?=$row['bedroom'];?>&nbsp;<i style="font-size:8px; transform: translate(0,-2px); color:#3b85c4;" class='bx bxs-circle'></i>
                        &nbsp;Land Size:&nbsp;<?=$row['lotSize'];?>&nbsp;
                    </div>
                    <div style="font-size: 15px; transform: translate(0,-5px); font-weight: 300;">
                        &nbsp;Garage&nbsp;<?=$row['garage'];?>&nbsp;<i style="font-size:8px; transform: translate(0,-2px); color:#3b85c4;" class='bx bxs-circle'></i>
                        &nbsp;Basement&nbsp;<?=$row['basement'];?>&nbsp;<i style="font-size:8px; transform: translate(0,-2px); color:#3b85c4;" class='bx bxs-circle'></i>
                        &nbsp;Floor Area:&nbsp;<?=$row['floorArea'];?>&nbsp;
                    </div>
                    <div style="overflow:hidden; text-overflow:ellipsis; font-size:15px; font-family: 'Open Sans', sans-serif; font-weight: 500;" >
                        &nbsp;Location:&nbsp;<?=$row['location']?>
                    </div>
                </div>
                <div>
                    <button id="btn_grid" class="btn btn-outline-success">View</button>
                    <button id="btn_grid" class="btn btn-outline-primary">Edit</button>
                    <button id="btn_grid" class="btn btn-outline-danger">Delete</button>
                    
                </div>
            </div>
    <?php }
        }else{ 
            echo '<tr><td colspan="6">No records found...</td></tr>'; 
        } ?>
    <div class="row" style="padding-left: 10px;">
        <?php echo $pagination->createLinks(); ?>
    </div>
<?php 
} 
?>