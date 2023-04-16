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
    $baseURL = 'propertyalldata.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 6; 
    
    //Set conditions for search 
    $whereSQL = ''; 
    $orderSQL = '';
    $where = ''; 
    if(!empty($_POST['keywords'])){ 
        $whereSQL = " AND (tbl_property.title LIKE '%".$_POST['keywords']."%' OR tbl_property.location LIKE '%".$_POST['keywords']."%' OR tbl_property.propertyType LIKE '%".$_POST['keywords']."%')"; 
    }

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
        $whereSQL .= " AND (tbl_transaction.status_Trans ='Sold' OR tbl_transaction.status_Trans = 'Rejected')"; 
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
    INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.agent_ID = '$var' ".$whereSQL); 
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
    tbl_user.fName AS userFname ,tbl_user.lName AS userLname, tbl_transaction.rate, tbl_agent.displayImg as Img, tbl_user.displayImg

    FROM (((tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
    INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.agent_ID = '$var' ".$whereSQL." ORDER BY trans_ID DESC LIMIT $offset,$limit");
?> 
    <!-- Data list container --> 
    <?php 
        if($query->num_rows > 0){
        while($res = $query->fetch_assoc()){
        //}
    ?>
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
            <?php
                $var3 = $res['property_ID'];
                $query1 = $connect->query("SELECT * FROM tbl_show WHERE property_ID = $var3");
                $result1  = $query1->fetch_assoc(); 
                echo '<img src="data:image/jpeg;base64,'.base64_encode($result1['propertyImg']).'" alt="hugenerd" class="card-img-top">';
            ?>
        </div>
        <div class="grid-item item3">
            <div class="rCont">
                <button class="btnView">View Agent</button>
                <button class="btnView">Chat</button>
                <?php if($res['rate'] != null){?>
                    <div style="font-size:15px; color:blue;">Rating:&nbsp;<i class='bx bxs-star' style='color:#f9ff00'></i><b><?php echo $res['rate']?></b></div>
                <?php }else{?>
                    <div style="font-size:15px; color:gray;"><b>No rating received</b></div>
                <?php }?>
            </div>
        </div>  
        <div class="grid-item item4">
            <div style="display:flex; gap:10px; text-align: center;">
                <div class="pclass">
                    <?php 
                        if(isset($res['displayImg'])){
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($res['Img']).'" width="50" height="50" class="rounded-circle">';
                        }else{
                            echo '<img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">';
                    }?>
                    <div class="flexcont">
                        <b><?php echo $res["lName"].', '.$res["fName"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>AGENT</b></div>
                    </div>
                </div>
                <div class="pclass">
                    <?php 
                        if(isset($res['Img'])){
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($res['displayImg']).'" width="50" height="50" class="rounded-circle">';
                        }else{
                            echo '<img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">';
                    }?>
                    <div class="flexcont">
                        <b><?php echo $res["userFname"].', '.$res["userLname"] ?>&nbsp;</b>
                        <div style="color:#90ee90;";><b>CLIENT</b></div>
                    </div>
                </div>
            </div>
            <div class="csub">
                <?php 
                    if($res['status_Trans'] == "Pending"){
                ?><form method="POST" onsubmit="return confirm('Are you sure?')" action="propertyalldata.php">
                    <input type="hidden" id="hide" name="hide" value="<?php echo $res['trans_ID'] ?>">
                    <input type="hidden" id="property" name="property" value="<?php echo $res['property_ID'] ?>">
                    <input type='submit' name='btn_Accept' id='btn_Accept' value="Accept" style="background-color: green;">
                    <input type='submit' name='btn_Cancel' id='btn_Cancel' value="Reject" style="background-color: red;">
                    </form>
                <?php }else{
                        if($_SESSION['enduser']=='user'){
                        ?>
                        <input type='submit' value="Contact Seller" style="background-color: gray;">
                <?php }}?>
            </div>
        </div>
    </div>
    <?php }
        }else{ 
            echo '<tr><td colspan="6">No records found...</td></tr>'; 
        } 
    ?>
    <div class="row">
        <?php echo $pagination->createLinks(); ?>
    </div>
<?php 
}
if (isset($_POST['btn_Accept'])) {
    $hidden = $_POST['hide'];
    $property = $_POST['property'];

    $sql3 = "UPDATE tbl_transaction SET `status_Trans`='Sold' WHERE trans_ID='$hidden'";
    $result3 = mysqli_query($connect, $sql3);

    $sql3 = "UPDATE tbl_property SET `statusProperty`='Sold' WHERE property_ID='$property'";
    $result3 = mysqli_query($connect, $sql3);

    if (isset($result3)) {
?>
        <script>
            alert('Successfully Sold');
            location = 'propertyall.php';
            exit;
        </script>
    <?php } else { ?>
        <script>
            alert('Transaction Failed');
            location = 'propertyall.php';
            exit;
        </script>
    <?php
    }
}

if (isset($_POST['btn_Cancel'])) {
    $hidden = $_POST['hide'];
    $property = $_POST['property'];

    $sql3 = "UPDATE tbl_transaction SET `status_Trans`='Rejected' WHERE trans_ID='$hidden'";
    $result3 = mysqli_query($connect, $sql3);

    $sql3 = "UPDATE tbl_property SET `statusProperty`='Active' WHERE property_ID='$property'";
    $result3 = mysqli_query($connect, $sql3);

    if (isset($result3)) {
    ?>
        <script>
            alert('Successfully Rejected');
            location = 'propertyall.php';
            exit;
        </script>
    <?php } else { ?>
        <script>
            alert('Transaction Failed');
            location = 'propertyall.php';
            exit;
        </script>
<?php
    }
}
?>