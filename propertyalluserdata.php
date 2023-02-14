<?php
session_start();
include('dbconfig.php');

$var = $_SESSION['user_ID'];
if(isset($_POST['page'])){ 
    // Include pagination library file 
    include_once 'Pagination.class.php'; 
     
    // Include database configuration file 
    require_once 'dbconfig.php';
    $filter = $_POST['filter'];

    // Set some useful configuration 
    $baseURL = 'propertyalluserdata.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 20; 
    
    //Set conditions for search 
    $whereSQL = ''; 
    $orderSQL = '';
    $where = ''; 

    if($filter == 'all'){ 
        $whereSQL .= ""; 
    }
    if($filter == 'pend'){ 
        $whereSQL .= " AND tbl_transaction.status_Trans ='Pending'"; 
    }
    if($filter == 'sold'){ 
        $whereSQL .= " AND tbl_transaction.status_Trans ='Sold'"; 
    }
    if($filter == 'rate'){ 
        $whereSQL .= " AND (tbl_transaction.status_Trans = 'Sold' OR tbl_transaction.status_Trans = 'Cancelled') AND tbl_transaction.rate IS NULL"; 
    }
    if($filter == 'cnl'){ 
        $whereSQL .= " AND tbl_transaction.status_Trans ='Cancelled'"; 
    }
    if($filter == 'rej'){ 
        $whereSQL .= " AND tbl_transaction.status_Trans ='Rejected'"; 
    }

    // if($_POST['filterBy'] != null){ 
    //     $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
    //     $whereSQL .= " location LIKE '%".$_POST['filterBy']."%'"; 
    // }
    // Count of all records 
    $query   = $connect->query("SELECT COUNT(tbl_transaction.trans_ID) as rowNum FROM (((tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
    INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.user_ID = '$var' ".$whereSQL); 
    $result  = $query->fetch_assoc(); 
    $rowCount= $result['rowNum']; 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'result', 
        'link_func' => 'searchFilter' 
    ); 
    $pagination =  new Pagination($pagConfig);
    // Fetch records based on the offset and limit 
    $query = $connect->query("SELECT 
    tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.trans_ID,
    tbl_transaction.property_ID, tbl_property.lotSize, tbl_property.floorArea, tbl_property.propertyType, tbl_property.price, tbl_transaction.status_Trans,
    tbl_user.fName AS userFname ,tbl_user.lName AS userLname, tbl_transaction.rate, tbl_agent.agent_ID

    FROM (((tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
    INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.user_ID = '$var' ".$whereSQL." ORDER BY trans_ID DESC LIMIT $offset,$limit");
?> 
    <!-- Data list container --> 
    
    <?php 
        if ($filter == 'rate') {
            if($query->num_rows > 0){
            while($res = $query->fetch_assoc()){
        //}
    ?>
    <form method="POST" onsubmit="return confirm('Are you sure?')" action="propertyalluserdata.php">
    <div class="boxx1">
        <div class="boxx3">
            <div style='text-align:center;'><b><?php echo $res['title']?></b></div>
            <div style='color:gray;'><b>Feedback:</b></div>
            <div style='font-size:14px; resize:none;'><textarea name="textA" id="textA" cols="83" rows="4" draggable="false" placeholder="Enter feedback here..." required></textarea></div>
        </div>
        <div class="grid-item item2">
            <img style='border-radius:10px;' src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="40" height="40" class="card-img-top">
        </div>
        <div class="grid-item item3">
            <form method="POST" action="propertyalluserdata.php">
                <input type="hidden" id="hide" name="hide" value="<?php echo $res['agent_ID'] ?>">
            <div class="rCont">
                <button class="btnView" type="submit" id="btn_hide" name="btn_hide">
                    View Agent
                </button>
                <button class="btnView">Chat</button>
                <div style="font-size:15px; color:gray;">
                    <select class="form-select" style="width:170px; background-color:lightblue; font-size:15px" name="srate" id="srate" required>
                        <option value="" selected disabled>Rate the Agent</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            </form>
        </div>  
        <div class="grid-item item4">
            <div style="display:flex; gap:10px; text-align: center;">
                <div class="pclass">
                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">
                    <div class="flexcont">
                        <b><?php echo $res["lName"].', '.$res["fName"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>AGENT</b></div>
                    </div>
                </div>
                <div class="pclass">
                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">
                    <div class="flexcont">
                        <b><?php echo $res["userFname"].', '.$res["userLname"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>CLIENT</b></div>
                    </div>
                </div>
            </div>
            <div class="csub">
                    <input type="hidden" id="hide" name="hide" value="<?php echo $res['trans_ID'] ?>">
                    <input type="hidden" id="property" name="property" value="<?php echo $res['property_ID'] ?>">
                    <input type="hidden" id="agent" name="agent" value="<?php echo $res['agent_ID'] ?>">
                    <input type="submit" id="btn_rate" value="Submit" name="btn_rate" class="btn-reject btn" style="background-color: dodgerblue;">
                </form>
            </div>
        </div>
    </div>
    </form>
    <?php }
        }else{ 
            echo '<tr><td colspan="6">No records found...</td></tr>'; 
        } 
    ?>
    <div class="row">
        <?php echo $pagination->createLinks(); ?>
    </div>

    <!-- _______________________ -->

    <?php 
        }else{
            if($query->num_rows > 0){
            while($res = $query->fetch_assoc()){
        //}
    ?>
    <form method="POST" action="propertyalluserdata.php">
    <div class="boxx1">
        <div class="boxx2">
            <div class="gridItem content1">
                <b><?php echo $res['title']?></b>
            </div>
            <div class="gridItem content2">
                <i class='bx bxs-map'></i>&nbsp;<small class="text-muted" style="line-height: 0; font-size: 15px;"><?php echo $res['location']?></small>
            </div>
            <div class="gridItem content3">
                Style:&nbsp;<i class='bx bx-home-smile'></i><b><?php echo $res['propertyType']?></b>
            </div>  
            <div class="gridItem content4">
                Price:&nbsp;<b>₱&nbsp;<?php echo $res['price']?></b>
            </div>
            <div class="gridItem content5">
                Lot Size:&nbsp;<i class='bx bx-area'></i><b><?php echo $res['lotSize']?></b>
            </div>  
            <div class="gridItem content6">
                Floor Area:&nbsp;<i class='bx bx-layout'></i><b><?php echo $res['lotSize']?></b>
            </div>
            <div class="gridItem content7">
                Status:&nbsp;<b><?php echo $res['status_Trans']?></b>
            </div>
        </div>
        <div class="grid-item item2">
            <img style='border-radius:10px;' src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="40" height="40" class="card-img-top">
        </div>
        <div class="grid-item item3">
            <form method="POST" action="propertyalluserdata.php">
                    <input type="hidden" id="hide" name="hide" value="<?php echo $res['agent_ID'] ?>">
            <div class="rCont">
                    <button class="btnView" type="submit" id="btn_hide" name="btn_hide">
                        View Agent
                    </button>
                <button class="btnView">Chat</button>
                
                <?php if($res['rate'] != null){?>
                    <div style="font-size:15px; color:blue;">Rating:&nbsp;<b><i class='bx bxs-star' style='color:#f9ff00'></i><?php echo $res['rate']?></b></div>
                <?php }else{?>
                    <div style="font-size:15px; color:gray;"><b>No rating received</b></div>
                <?php }?>
            </div>
            </form>
        </div>  
        <div class="grid-item item4">
            <div style="display:flex; gap:10px; text-align: center;">
                <div class="pclass">
                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">
                    <div class="flexcont">
                        <b><?php echo $res["lName"].', '.$res["fName"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>AGENT</b></div>
                    </div>
                </div>
                <div class="pclass">
                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">
                    <div class="flexcont">
                        <b><?php echo $res["userFname"].', '.$res["userLname"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>CLIENT</b></div>
                    </div>
                </div>
            </div>
            <div class="csub">
                <?php if($res['status_Trans'] == "Pending"){?>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to cancel?')" action="propertyalluserdata.php">
                    <input type="hidden" id="hide" name="hide" value="<?php echo $res['trans_ID'] ?>">
                    <input type="hidden" id="property" name="property" value="<?php echo $res['property_ID'] ?>">
                    <input type="submit" id="btn_Cancel" value="Cancel" name="btn_Cancel" class="btn-reject btn" style="background-color: red;">
                <?php }else{
                        if($_SESSION['enduser']=='user'){
                        ?>
                        <input type='submit' value="Contact Seller" style="background-color: gray;">
                <?php }}?>
                </form>
            </div>
        </div>
    </div>
    </form>
    <?php }
        }else{ 
            echo '<tr><td colspan="6">No records found...</td></tr>'; 
        } 
    ?>
    <div class="row">
        <?php echo $pagination->createLinks(); ?>
    </div>
    <?php }?>

<?php 
}
if (isset($_POST['btn_hide'])) {
    $hide = $_POST['hide'];
    if (isset($hide)) {
        $_SESSION['agentselected'] = $hide;
?>
        <script>
            location = 'agentportfolio.php';
            exit;
        </script>
<?php
    }
}

if (isset($_POST['btn_Accept'])) {
    $hidden = $_POST['hide'];

    $sql3 = "UPDATE tbl_transaction SET `rate`='Sold' WHERE trans_ID='$hidden'";
    $result3 = mysqli_query($connect, $sql3);

    if (isset($result3)) {
?>
        <script>
            alert('Successfully Sold');
            location = 'propertyalluser.php';
            exit;
        </script>
    <?php } else { ?>
        <script>
            alert('Transaction Failed');
            location = 'propertyalluser.php';
            exit;
        </script>
    <?php
    }
}

if (isset($_POST['btn_rate'])) {
    $hidden = $_POST['hide'];
    $textA = $_POST['textA'];
    $srate = $_POST['srate'];
    $agent = $_POST['agent'];
    $sql3 = "UPDATE tbl_transaction SET `rate`= '".$srate."', feedback='".$textA."' WHERE trans_ID='$hidden'";
    $result3 = mysqli_query($connect, $sql3);

    $query1 = $connect->query("SELECT 
    tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.trans_ID,
    tbl_transaction.property_ID, tbl_property.lotSize, tbl_property.floorArea, tbl_property.propertyType, tbl_property.price, tbl_transaction.status_Trans,
    tbl_transaction.rate, tbl_agent.agent_ID

    FROM tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID WHERE tbl_transaction.agent_ID = '".$agent."' AND tbl_transaction.rate IS NOT NULL");
    
    $count1 = 0;
    $count2 = 0;
    $count3 = 0;
    $count4 = 0;
    $count5 = 0;
    while($res2 = $query1->fetch_assoc()){
        if($res2['rate'] == 5){
            $count5++;
        }elseif($res2['rate'] == 4){
            $count4++;
        }elseif($res2['rate'] == 3){
            $count3++;
        }elseif($res2['rate'] == 2){
            $count2++;
        }elseif($res2['rate'] == 1){
            $count1++;
        }
    }
    
    $allrate = $count1+$count2+$count3+$count4+$count5;
    $rating = ((($count5 * 5)+($count4 * 4)+($count3 * 3)+($count2 * 2)+($count1 * 1))/$allrate);
    echo $allrate."&".$count5."&".$count4."&".$rating;
    $rating = number_format((float)$rating, 2, '.', '');
    $sql4 = "UPDATE tbl_agent SET `prate`= '".$rating."', total_rate='".$allrate."' WHERE agent_ID='$agent'";
    $result4 = mysqli_query($connect, $sql4);
    if (isset($result3)) {
?>
        <script>
            alert('Rate and Feedback Done');
            location = 'propertyalluser.php';
            exit;
        </script>
    <?php } else { ?>
        <script>
            alert('Transaction Failed');
            location = 'propertyalluser.php';
            exit;
        </script>
    <?php
    }
}

if (isset($_POST['btn_Cancel'])) {
    $hidden = $_POST['hide'];
    $property = $_POST['property'];

    $sql3 = "UPDATE tbl_transaction SET `status_Trans`='Cancelled' WHERE trans_ID='$hidden'";
    $result3 = mysqli_query($connect, $sql3);

    $sql3 = "UPDATE tbl_property SET `statusProperty`='Active' WHERE property_ID='$property'";
    $result3 = mysqli_query($connect, $sql3);

    if (isset($result3)) {
    ?>
        <script>
            alert('Successfully Cancelled');
            location = 'propertyalluser.php';
            exit;
        </script>
    <?php } else { ?>
        <script>
            alert('Transaction Failed');
            location = 'propertyalluser.php';
            exit;
        </script>
<?php
    }
}
?>