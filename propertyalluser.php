<?php
include_once 'header.php';
include 'chome.php';
include('dbconfig.php');

// Include pagination library file 
include_once 'Pagination.class.php'; 
 
// Set some useful configuration 
$baseURL = 'propertyalluserdata.php'; 
$limit = 20; 
$var = $_SESSION['user_ID'];

// Count of all records 
$query   = $connect->query("SELECT COUNT(tbl_transaction.trans_ID) as rowNum FROM (((tbl_transaction
INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.user_ID = '$var' ");
$result  = $query->fetch_assoc(); 
$rowCount= $result['rowNum']; 
 
// Initialize pagination class 
$pagConfig = array( 
    'baseURL' => $baseURL, 
    'totalRows' => $rowCount, 
    'perPage' => $limit, 
    'contentDiv' => 'result', 
    'link_func' => 'searchFilter' 
); 
$pagination =  new Pagination($pagConfig);


$query = $connect->query("SELECT 
    tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.trans_ID,
    tbl_transaction.property_ID, tbl_property.lotSize, tbl_property.floorArea, tbl_property.propertyType, tbl_property.price, tbl_transaction.status_Trans,
    tbl_user.fName AS userFname ,tbl_user.lName AS userLname, tbl_transaction.rate, tbl_transaction.agent_ID, tbl_agent.displayImg as Img, tbl_user.displayImg

    FROM (((tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
    INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.user_ID = '$var' ORDER BY trans_ID DESC LIMIT $limit"); 
?>

<style>
    <?php include 'css/addproperty.css' ?>
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<?php
    $sql = "SELECT 
        tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.trans_ID,
        tbl_transaction.property_ID, tbl_property.lotSize, tbl_property.floorArea, tbl_property.propertyType, tbl_property.price, tbl_transaction.status_Trans,
        tbl_user.fName AS userFname ,tbl_user.lName AS userLname, tbl_transaction.trans_ID, tbl_transaction.rate, tbl_transaction.agent_ID, tbl_agent.displayImg as Img, tbl_user.displayImg
        
        FROM (((tbl_transaction
        INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
        INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) 
        INNER JOIN tbl_user ON tbl_transaction.user_ID = tbl_user.user_ID) WHERE tbl_transaction.user_ID = '$var' ORDER BY trans_ID DESC";
    $result = mysqli_query($connect, $sql);


    $sql = "SELECT * FROM tbl_user WHERE user_ID=".$var;
    $result1 = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result1);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    function searchFilter(page_num, btn_Data) {
        page_num = page_num?page_num:0;

        // $('#all').click(All)
        // $('#pend').click(Pend)
        // $('#sold').click(Sold)
        // $('#rate').click(Rate)
        // $('#cnl').click(Cnl)
        // $('#rej').click(Rej)
        if (btn_Data == 'all') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
        else if (btn_Data == 'pend') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
        else if (btn_Data == 'sold') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
        else if (btn_Data == 'rate') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
        else if (btn_Data == 'cnl') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
        else if (btn_Data == 'rej') {
            $.ajax({
                type: 'POST',
                url: 'propertyalluserdata.php',
                data:'page='+page_num+'&filter='+btn_Data,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (html) {
                    $('#result').html(html);
                    $('.loading-overlay').fadeOut("slow");
                }
            });
        }
    }

    function chat(dataF) {
        // let filter = $('#all').val();
        console.log(dataF);
        $.ajax({
        type: 'POST',
        url: 'chat.php',
        data:'filter='+dataF,
        success: function (html) {
            $('#chatResult').html(html);
        }
        });
    }
</script>
<main role="main" class='main'>
    <section class="topsection d-flex flex-column justify-content-center align-items-center">
        <i class="bi bi-house-door-fill"></i>
        <span class="display-6 mb-4">My Profile and Property</span>
    </section>

    <section class="midsection">
        <div style="padding-top:20px;">
            <div class="pclass" style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);'>
                <?php 
                if(isset($row['displayImg'])){
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['displayImg']).'" width="50" height="50" class="rounded-circle">';
                }else{
                    echo '<img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="50" height="50" class="rounded-circle">';
                }?>
                <div class="flex-container">
                    <b><?php echo $row["fName"].', '.$row["lName"] ?></b>
                    <div style="color:#90ee90;";>Status: Verified</div>
                </div>
            </div>
            <br>
            <div class='sidebox'>
                <!-- &nbsp;&nbsp;<i class='bx bxs-user'></i><a href="#">My Account</a> -->
                &nbsp;&nbsp;<i class='bx bxs-home' ></i><a href="#">My Property</a>
                <br>
                <div class='ccontainer'>
                    <div>&nbsp;&nbsp;<i class='bx bx-bookmark-heart'></i>Favorites</div>
                    <a href="#">&nbsp;&nbsp;Properties</a><br>
                    <a href="#">&nbsp;&nbsp;Agent</a>
                </div>
            </div>
        </div>
        <div class="card2">
            <ul class="ulclass">
                <li><button class="btnAll" name="all" id="all" value="all" onclick="searchFilter('','all');">All</button></li>
                <li><button class="btnPending" name="pend" id="pend" value="pend" onclick="searchFilter('','pend');">Pending</button></li>
                <li><button class="btnSold" name="sold" id="sold" value="sold" onclick="searchFilter('','sold');">Sold</button></li>
                <li><button class="btnRate" name="rate" id="rate" value="rate" onclick="searchFilter('','rate');">To Rate</button></li>
                <li><button class="btnCnl" name="cnl" id="cnl" value="cnl" onclick="searchFilter('','cnl');">Cancelled</button></li>
                <li><button class="btnRej" name="rej" id="rej" value="rej" onclick="searchFilter('','rej');">Reject</button></li>
            </ul>
            <div id= "result" class="boxx">
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

                        <form method="POST" action="propertyalluser.php">
                                <input type="hidden" id="hide" name="hide" value="<?php echo $res['agent_ID'] ?>">
                                
                                <button style="width:180px;" class="btnView" type="submit" id="btn_hide" name="btn_hide">
                                    View Agent
                                </button>
                        </form>
                        
                            <button id="btn_chat" name="btn_chat" class="btnView" onclick="chat('<?=$res['fName']?>')">Chat</button>
                            <?php if($res['rate'] != null){?>
                                <div style="font-size:15px; color:blue;">Rating:&nbsp;<b><i class='bx bxs-star' style='color:#f9ff00'></i><?php echo $res['rate']?></b></div>
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
                            ?><form method="POST" onsubmit="return confirm('Are you sure you want to cancel?')" action="propertyalluser.php">
                                <input type="hidden" id="property" name="property" value="<?php echo $res['property_ID'] ?>">
                                <input type="hidden" id="hide" name="hide" value="<?php echo $res['trans_ID'] ?>">
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
                <?php }
                    }else{ 
                        echo '<tr><td colspan="6">No records found...</td></tr>'; 
                    } 
                ?>
                <div class="row">
                    <?php echo $pagination->createLinks(); ?>
                </div>
            </div>
        
            </div>
        </div>
    </section>
</main>
<?php

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

