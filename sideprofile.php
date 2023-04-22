<?php
include_once 'header.php';
include('dbconfig.php');
include 'chome.php';
?>

<style>
    <?php include 'css/sideprofile.css' ?>
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                    &nbsp;&nbsp;<a class="btn btn-dark dropdown-toggle" id="btn_prof" href="#" role="button" style="width: 180px;text-align: left; border-radius:10px;" data-bs-toggle="dropdown" aria-expanded="false">
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
            <div id="result" class="boxx">
                <br>
                <div class="boxx1">
                    <div class="box">
                        <h5 style="font-weight:620;">Manage and protect your account</h5><hr>
                        <form action="sideprofile.php" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">                          
                            <div class="gcontainer">
                                <div>
                                    <div class="ginput">
                                        <div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="fname" value="<?php echo $row['fName'] ?>" placeholder="Enter Firstname here.." readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Middle Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="mname" value="<?php echo $row['mName'] ?>" placeholder="Enter Middlename here.." readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lname" value="<?php echo $row['lName'] ?>" placeholder="Enter Lastname here.." readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Birthday</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="bday" value="<?php echo $row['bday'] ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Sex</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="sex" id="sex" disabled required>
                                                        <option value="<?php echo $row['sex'] ?>">:<?php echo $row['sex'] ?></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Phone Number</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" name="contact" maxlength="11" value="<?php echo $row['contactNo'] ?>" placeholder="0987654321" readonly required>
                                                </div>
                                            </div>
                                            <?php if($_SESSION['enduser'] != 'User'){?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Agency</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" name="agency" value="<?php echo $row['agency'] ?>" placeholder="Enter Agency name here.." readonly required>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="city" id="city" disabled required>
                                                        <option value="<?php echo $row['city'] ?>">:<?php echo $row['city'] ?></option>
                                                        <option value="Abucay">Abucay</option>
                                                        <option value="Bagac">Bagac</option>
                                                        <option value="Balanga">Balanga</option>
                                                        <option value="Dinalupihan">Dinalupihan</option>
                                                        <option value="Hermosa">Hermosa</option>
                                                        <option value="Limay">Limay</option>
                                                        <option value="Mariveles">Mariveles</option>
                                                        <option value="Morong">Morong</option>
                                                        <option value="Orani">Orani</option>
                                                        <option value="Orion">Orion</option>
                                                        <option value="Pilar">Pilar</option>
                                                        <option value="Samal">Samal</option>
                                                    </select>
                                                    <input type="text" class="form-control" name="brgy" value="<?php echo $row['brgy'] ?>" placeholder="Barangay" readonly required>
                                                    <input type="text" class="form-control" name="str" value="<?php echo $row['str'] ?>" placeholder="1234 Main St" readonly required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row" style="display: none;" id="divConfirm">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter current/old password to proceed update.." required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="d-flex col-20 justify-content-center">
                                                    <button type="submit" name="btn_saveChangesAgent" id="btn_saveChangesAgent" class="btn btn-dark" style="display: none;">Save Changes</button>
                                                </div>
                                            </div>
                                            <div class="d-flex col-20 justify-content-center">
                                                <button name="btn_Edit" id="btn_Edit" onclick="setDisable()" class="btn btn-dark" style="display: block;">Edit</button>
                                                <button name="btn_Cancel" id="btn_Cancel" onclick="window.location.href='sideprofile.php';" class="btn btn-dark" style="display: none;">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4 d-flex justify-content-center">
                                        <?php
                                            if ($row['displayImg']) {
                                            ?>
                                                <?php echo is_null($row["displayImg"]) ? "-Empty-" : '<img  src="data:image/jpeg;base64,' . base64_encode($row['displayImg']) . '" style="width: 200px;">'; ?>
                                            <?php
                                            } else {
                                            ?>
                                                <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 200px;" />
                                            <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div id="custom1" class="btn btn-dark" style="display: none; width:70%;">
                                            <!-- <label class="form-label text-white m-1" for="customFile1">Choose file</label> -->
                                            <input type="file" accept="image/*" name="dPhoto" class="form-control" id="customFile1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    //To make inputs editable 
    function setDisable() {
        let getControl = document.getElementsByClassName("form-control");
        let getSelect = document.getElementsByClassName("form-select");
        document.getElementById("custom1").style.display = "block";
        document.getElementById("btn_Cancel").style.display = "block";
        document.getElementById("btn_saveChangesAgent").style.display = "block";
        document.getElementById("btn_Edit").style.display = "none";
        document.getElementById("divConfirm").style.display = "flex";
        for (let input of getControl) {
            input.removeAttribute('readonly');
        }
        for (let select of getSelect) {
            select.disabled = false;
        }
    }

    //To make inputs readOnly
    // function setCancel(){
    //     let getControl = document.getElementsByClassName("form-control")
    //     let getSelect = document.getElementsByClassName("form-select")
    //     document.getElementById("divTitle").innerHTML = "Profile";
    //     document.getElementById("custom1").style.display = "none";
    //     document.getElementById("btn_Cancel").style.display = "none";
    //     document.getElementById("btn_saveChangesAgent").style.display = "none";
    //     document.getElementById("btn_Edit").style.display = "block";
    //     document.getElementById("divConfirm").style.display = "none";
    //     for (let input of getControl){
    //         input.readOnly = true;
    //     }
    //     for (let select of getSelect){
    //         select.disabled = true;
    //     }
    // }
</script>
<?php
if (isset($_POST['btn_saveChangesAgent'])) {
    $password = $_POST["password"];
    if (!password_verify($password, $row['password'])) {
        $_SESSION['status'] = "Password is incorrect";?>
        <script>
            location = 'sideprofile.php';
            exit;
        </script>
    <?php }else{

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];
    $bday = $_POST["bday"];
    $sex = $_POST["sex"];
    $contact = $_POST["contact"];
    
    $city = $_POST["city"];
    $brgy = $_POST["brgy"];
    $str = $_POST["str"];
    $dPhoto = $_FILES['dPhoto']['tmp_name'];
    $id = $_SESSION['user_ID'];

    if ($_SESSION['enduser'] != 'User') {
        $agency = $_POST["agency"];
        if ($dPhoto) {
            $dPhoto1 = addslashes(file_get_contents($dPhoto)) ?? "";
            $sql = "UPDATE `tbl_agent` SET fName ='$fname', lName ='$lname', mName ='$mname', bday ='$bday', sex ='$sex', contactNo ='$contact',
            agency ='$agency', city ='$city', brgy ='$brgy', str ='$str', displayImg = '$dPhoto1' WHERE agent_ID ='$id'";
            $update = mysqli_query($connect, $sql);
        } else {
            $sql = "UPDATE `tbl_agent` SET fName ='$fname', lName ='$lname', mName ='$mname', bday ='$bday', sex ='$sex', contactNo ='$contact',
            agency ='$agency', city ='$city', brgy ='$brgy', str ='$str' WHERE agent_ID ='$id'";
            $update = mysqli_query($connect, $sql);
        }
    }else {
        if ($dPhoto) {
            $dPhoto1 = addslashes(file_get_contents($dPhoto)) ?? "";
            $sql = "UPDATE `tbl_user` SET fName ='$fname', lName ='$lname', mName ='$mname', bday ='$bday', sex ='$sex', contactNo ='$contact',
            city ='$city', brgy ='$brgy', str ='$str', displayImg = '$dPhoto1' WHERE user_ID ='$id'";
            $update = mysqli_query($connect, $sql);
        } else {
            $sql = "UPDATE `tbl_user` SET fName ='$fname', lName ='$lname', mName ='$mname', bday ='$bday', sex ='$sex', contactNo ='$contact',
            city ='$city', brgy ='$brgy', str ='$str' WHERE user_ID ='$id'";
            $update = mysqli_query($connect, $sql);
        }
    }

    if (isset($update)) {

        $_SESSION['status'] = "Profile Successfully Updated";?>
        <script>
            location = 'sideprofile.php';
            exit;
        </script>
    <?php } else {
         $_SESSION['status'] = "Profile Failed to Update";?>
        <script>
            location = 'sideprofile.php';
            exit;
        </script>
<?php
    }
}
}
?>
