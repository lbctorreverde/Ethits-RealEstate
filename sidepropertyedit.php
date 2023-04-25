<?php
include_once 'header.php';
include('dbconfig.php');
include 'chome.php';
define('BASE_URL', 'http://example.com');

?>

<style>
    <?php include 'css/sidepropertychange.css' ?>
</style>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js" ></script>

<?php
    $varedit = $_GET['edit'];
    $edit = $connect->query("SELECT * FROM tbl_property WHERE property_ID='$varedit'");
    $resEdit = $edit->fetch_assoc();
?>

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
                        <li><a class="dropdown-item" href="sidepassword.php">Change Password</a></li>
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
            <div id="result" class="boxx">
                <br>
                <div class="boxx1">
                    <div class="box">
                        <h5 style="font-weight:620;">Edit Property</h5><hr>
                            <div class="gcontainer">
                            <form action="sidepropertyedit.php?edit=<?=$varedit?>" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                                <div>
                                    <div class="ginput">
                                        <div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Property Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?=$resEdit['title']?>" name="title" id="title" placeholder="Enter Title here.." required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="stats" id="stats" required>
                                                        <option value="<?=$resEdit['statusProperty']?>">:<?=$resEdit['statusProperty']?></option>
                                                        <option value="Active">Active</option>
                                                        <option value="Sold">Sold</option>
                                                    </select>                                                
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?=$resEdit['location']?>" name="location" id="location" placeholder="Enter Address here..." required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Property Type</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="ptype" id="ptype" required>
                                                        <option value="<?=$resEdit['propertyType']?>">:<?=$resEdit['propertyType']?></option>
                                                        <option value="Bungalow">Bungalow</option>
                                                        <option value="Contemporary">Contemporary</option>
                                                        <option value="Cottage">Cottage</option>
                                                        <option value="Duplex">Duplex</option>
                                                        <option value="Modern">Modern</option>
                                                        <option value="Rowhouse">Rowhouse</option>
                                                        <option value="Townhouse">Townhouse</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Features</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="sf" id="sf" value="<?=$resEdit['specialFeatures']?>" placeholder="Enter additonal features..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Price</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step=0.25 min=0 class="form-control" value="<?=$resEdit['price']?>" name="price" placeholder="0" id="price">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Bathroom</label>
                                                <div class="col-sm-1">
                                                    <input type="number" class="form-control" value="<?=$resEdit['bathroom']?>" name="bath" id="bath" placeholder="0" min="0" style="width:65px;"  required>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label for="inputEmail3" class="col-sm-2 col-form-label">Bedroom</label>
                                                <div class="col-sm-1">
                                                    <input type="number" class="form-control" name="bed" id="bed" value="<?=$resEdit['bedroom']?>" placeholder="0" min="0"style="width:65px;" required>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Lot Size (m²)</label>
                                                <div class="col-sm-1">
                                                    <input type="number" class="form-control" name="lot" id="lot" value="<?=$resEdit['lotSize']?>" placeholder="0" style="width:75px;" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Garage</label>
                                                <div class="col-sm-1">
                                                    <select class="form-select" name="garage" style="width:75px;" id="garage" required>
                                                        <option value="<?=$resEdit['garage']?>">:<?=$resEdit['garage']?></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label for="inputEmail3" class="col-sm-2 col-form-label">Basement</label>
                                                <div class="col-sm-1">
                                                    <select class="form-select" name="basement" style="width:75px;" id="basement" required>
                                                        <option value="<?=$resEdit['basement']?>">:<?=$resEdit['basement']?></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Floor Area (m²)</label>
                                                <div class="col-sm-1">
                                                    <input type="number" class="form-control"  name="area" id="area" value="<?=$resEdit['floorArea']?>" placeholder="0"  style="width:75px;" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Add Pictures</label>
                                                <div class="col-sm-9">
                                                    <input type="file" accept="image/*" style="cursor:pointer;" onchange="preview()" name="propertyImg[]" class="form-control" id="propertyImg" multiple/>
                                                </div>
                                            </div>
                                            <div class="d-flex col-29 justify-content-center">
                                                <input type="hidden" value="<?=$resEdit['property_ID']?>" id="propID" name="propID">
                                                <button type="submit" name="btn_saveChangesAgent" id="btn_saveChangesAgent" class="btn btn-dark" style="display: block;">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="submit" onclick="window.location.reload();" class="btn btn-dark" style="display: block;">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="container">
                                <!-- Main view of our gallery -->
                                <div class="main_view">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" title="Select Picture(s) under to view" id="main" width="100px " alt="IMAGE">
                                </div>
                        
                                <!-- All images with side view -->
                                <div class="side_view">
                                    <?php
                                        $allpic = $connect->query("SELECT * FROM tbl_show WHERE property_ID ='$varedit'");
                                        $i = 0;
                                        while($pics = $allpic->fetch_assoc()){
                                            $i++;?>
                                            <div style="background-color:whitesmoke; padding: 10px;">
                                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($pics['propertyImg']).'" onclick="change(this.src)">';?>
                                            </div>
                                            <form action="sidepropertyedit.php?edit=<?=$varedit?>" onsubmit="return confirm('<?php echo 'Are you sure you want to delete this picture'?>');" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                                                <div style="background-color:whitesmoke; padding: 10px; display: flex;">
                                                    <input type="hidden" value="<?=$pics['show_ID']?>" id="hide_ID" name="hide_ID">
                                                    Picture#<?=$i?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <button type="submit" name="btn_delete" id="btn_delete" class="btn btn-dark" style="display: block; transform:translate(0, 0%)">Delete</button>
                                                </div>
                                            </form>
                                    <?php }?>
                                </div>
                            </div> 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    function change(pic){
        document.getElementById('main').src = pic
    }
  
</script>
<?php
$var = $_SESSION['user_ID'];
if (isset($_POST['btn_delete'])) {
    $hide_ID = $_POST['hide_ID'];
    $query = $connect->query("DELETE FROM tbl_show WHERE show_ID='$hide_ID'");
    if ($result) {
        $_SESSION['status'] = "Successfully Deleted";?>
        <script>
            location = 'sidepropertyedit.php?edit=<?=$varedit?>';
            exit;
        </script>
        <?php }else{
        $_SESSION['status'] = "Failed to Delete";?>
        <script>
            location = 'sidepropertyedit.php?edit=<?=$varedit?>';
            exit;
        </script>
        <?php
    }
}


if(isset($_POST['btn_saveChangesAgent'])){
    $propID = $_POST['propID'];
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

    $quertInsert = $connect->query("UPDATE `tbl_property` SET `agent_ID`='$var',`title`='$title',`location`='$location',`propertyType`='$ptype',
    `bedroom`='$bed',`bathroom`='$bath',`basement`='$basement',`garage`='$garage',`lotSize`='$lot',`floorArea`='$area',
    `specialFeatures`='$sf',`price`='$price',`statusProperty`='$stats' 
    WHERE property_ID='$propID' ");
    
    $query1 = "SELECT * from tbl_property WHERE title = '$title'";
    $result1 = mysqli_query($connect, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $var1 = $row1['property_ID'];

    if (!empty($_FILES['propertyImg']['name'][0])) {
        $countfiles = count($dp);
        echo $countfiles;
        for($i=0;$i<$countfiles;$i++){
            $filename = addslashes(file_get_contents($_FILES['propertyImg']['tmp_name'][$i])) ?? "";
            $sqlUpload = "INSERT INTO tbl_show(property_ID, propertyImg, date_Time) 
            VALUES ('$var1','$filename',NOW())";
            $result = mysqli_query($connect, $sqlUpload);
        }
    }
    
    if ($result) {
        $_SESSION['status'] = "Property Updated Successfully";?>
        <script>
            location = 'sidepropertyedit.php?edit=<?=$varedit?>';
            exit;
        </script>
        <?php }else{
        $_SESSION['status'] = "Property Failed to Update";?>
        <script>
            location = 'sidepropertyedit.php?edit=<?=$varedit?>';
            exit;
        </script>
        <?php
    }
        
  
    }