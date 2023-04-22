<?php
include_once 'header.php';
include('dbconfig.php');
include 'chome.php';


// Include pagination library file 
include_once 'Pagination.class.php';

// Set some useful configuration 
$baseURL = 'sidepropertycode.php';
$limit = 6;
$var = $_SESSION['user_ID'];

// Count of all records 
$query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_property WHERE agent_ID ='$var'"); 
$result  = $query->fetch_assoc(); 
$rowCount= $result['rowNum']; 
 
// Initialize pagination class 
$pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'contentDiv' => 'result',
    'link_func' => 'searchProperty'
);
$pagination =  new Pagination($pagConfig);
$query = $connect->query("SELECT * FROM tbl_property WHERE agent_ID= '$var' ORDER BY property_ID DESC LIMIT $limit");
?>

<style>
    <?php include 'css/sideproperty.css' ?>
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    function searchProperty(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var styleBy = $('#style').val();

        $.ajax({
            type: 'POST',
            url: 'sidepropertycode.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&styleBy=' + styleBy,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#result').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }

    function addProperty(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var styleBy = $('#style').val();

        $.ajax({
            type: 'POST',
            url: 'sidepropertycode.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&styleBy=' + styleBy,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#result').html(html);
                $('.loading-overlay').fadeOut("slow");
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
                    <b><?php echo $row["lName"].', '.$row["fName"] ?></b>
                    <div style="color:#90ee90;";>Status: Verified</div>
                </div>
            </div>
            <br>
            <div class='sidebox'>
                <!-- &nbsp;&nbsp;<i class='bx bxs-user'></i><a href="#">My Account</a> -->
                <div class="dropdown">
                    &nbsp;&nbsp;<a class="btn btn-white dropdown-toggle" id="btn_a" href="#" role="button" style="width: 180px;text-align: left; border-radius:10px;" data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="sideprofile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Documents</a></li>
                        <li><a class="dropdown-item" href="#">Change Password</a></li>
                    </ul>
                </div>
                <?php if ($_SESSION['enduser'] != 'User') {?>
                    &nbsp;&nbsp;<a id="btn_a" style="width: 180px;text-align: left; border-radius:10px;" class="btn btn-white" href="sideproperty.php"><i class='bx bxs-building-house'></i>&nbsp;My Properties</a><br>
                <?php }
                if ($_SESSION['enduser'] == 'User') {?>
                    &nbsp;&nbsp;<a id="btn_a" style="width: 180px;text-align: left;border-radius:10px;" class="btn btn-white" href="propertyalluser.php"><i class='bx bxs-spreadsheet'></i></i>&nbsp;Transaction</a><br>
                <?php }else{?>
                    &nbsp;&nbsp;<a id="btn_a" style="width: 180px;text-align: left;border-radius:10px;" class="btn btn-white" href="propertyall.php"><i class='bx bxs-spreadsheet'></i></i>&nbsp;Transaction</a><br>
                <?php }?>
                &nbsp;&nbsp;<a id="btn_a" style="width: 180px;text-align: left;border-radius:10px;" class="btn btn-white" href="#"><i class='bx bxs-bell'></i>&nbsp;Notifications</a><br>
                <!-- <div class='ccontainer'>
                    <div>&nbsp;&nbsp;<i class='bx bx-bookmark-heart'></i>Favorites</div>
                    <a href="#">&nbsp;&nbsp;Properties</a><br>
                    <a href="#">&nbsp;&nbsp;Agent</a>
                </div> -->
            </div>
        </div>
        <div class="card2">
                <div class="boxx">
                    <!-- <button id="myBtn">Open Modal</button>
                    
                    <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Some text in the Modal..</p>
                    </div>
                    </div> -->
                <br>
                <div class="boxx1">
                    <div class="upper">
                        <div class='form'>
                            <input type="search" id="keywords" name="keywords" placeholder="Search..." aria-label="Search through site content" onkeyup="searchProperty();"><i class='bx bx-search-alt'></i>
                        </div>
                        <div>
                            <select class="form-select" name="style" id="style" onchange="searchProperty();">
                                <option value="" selected disabled>Status</option>
                                <option value="All">All</option>
                                <option value="Active">Active</option>
                                <option value="Sold">Sold</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-dark" onclick="window.location.href='sidepropertyadd.php'" id="btn_add">Property Add</button>
                        </div>
                    </div>
                    <div id="result" class="box">
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
                                        <button id="btn_grid" onclick="window.location.href='sidepropertyadd.php?view=<?=$row['property_ID']?>'" class="btn btn-outline-success">View</button>
                                        <button id="btn_grid" onclick="window.location.href='sidepropertyedit.php?edit=<?=$row['property_ID']?>'" class="btn btn-outline-primary">Edit</button>
                                        <form action="sideproperty.php" onsubmit="return confirm('<?php echo 'Are you sure you want to delete this property'?>');" method="POST" id="signup-form" enctype="multipart/form-data">
                                            <input type="hidden" value="<?=$row['property_ID']?>" id="hide_ID" name="hide_ID">
                                            <button id="btn_delete" name="btn_delete" style="width: 100%; height: 28%; margin-bottom: 10px;" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                        <?php }
                            }else{ 
                                echo '<tr><td colspan="6">No records found...</td></tr>'; 
                            } ?>
                        <div style="padding-left: 10px;">
                            <?php echo $pagination->createLinks(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</main>
<footer id="sticky-footer" class="sticky-footer flex-shrink-0 py-4">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>

<?php 
if (isset($_POST['btn_delete'])) {
    $hide_ID = $_POST['hide_ID'];
    $query = $connect->query("DELETE FROM tbl_property WHERE property_ID='$hide_ID'");
    if ($result) {
        $_SESSION['status'] = "Successfully Deleted";?>
        <script>
            location = 'sideproperty.php';
            exit;
        </script>
        <?php }else{
        $_SESSION['status'] = "Failed to Delete";?>
        <script>
            location = 'sideproperty.php';
            exit;
        </script>
        <?php
    }
}
?>

