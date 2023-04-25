<?php
include_once 'header.php';
include('dbconfig.php');
include 'chome.php';

?>

<style>
    <?php include 'css/sidepropertychange.css' ?>
</style>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js" ></script>
<script>
    function showPass() {
        var newPass = document.getElementById("new");
        var confirm = document.getElementById("confirm");
        var current = document.getElementById("current");
        if (newPass.type == "password") {
            newPass.type = "text";
            confirm.type = "text";
            current.type = "text";
        } else {
            newPass.type = "password";
            confirm.type = "password";
            current.type = "password";
        }
    }

    $(function(){
        $("#confirm").on("keyup", function () {
            var fst=$("#confirm").val();
            var sec=$("#new").val();
            if (sec != fst) {
                document.getElementById("incorrect").style.display = "block";
                document.getElementById("btn_saveChanges").disabled = true;
            }else{
                document.getElementById("incorrect").style.display = "none";
                document.getElementById("btn_saveChanges").disabled = false;
            }
        })
    })
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
                <div class="boxcontain">
                    <div class="box">
                        <h5 style="font-weight:620;">Change Password</h5><hr>
                        <div class="gcontainer">
                            <form action="sidepassword.php" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                                <div>
                                    <div class="ginput">
                                        <div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="new" id="new" placeholder="******" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="******" required>
                                                    <small id="incorrect" name="incorrect" style="color:red; display:none;">Password entered is different</small>
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="current" id="current" placeholder="******" required>
                                                </div>
                                            </div>
                                            <div class="d-flex col-9 justify-content-center">
                                                <input type="checkbox" onclick="showPass()">&nbsp;&nbsp;Show Password
                                            </div>
                                            <br>
                                            <div class="d-flex col-9 justify-content-center">
                                                <input type="hidden" value="<?=$resEdit['property_ID']?>" id="propID" name="propID">
                                                <button type="submit" name="btn_saveChanges" id="btn_saveChanges" class="btn btn-dark" style="display: block;">Confirm</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="reset" class="btn btn-dark" style="display: block;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div style="padding:15px;">
                                <a href="">Forgot your password?</a>
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

if ($_SESSION['enduser'] == 'Agent') {
    $query=$connect->query("SELECT * FROM tbl_agent WHERE agent_ID='$var'");
    $resquery = $query->fetch_assoc();

    if(isset($_POST['btn_saveChanges'])){
        $current = $_POST['current'];
        if (!password_verify($current, $resquery['password'])) {
            $_SESSION['status'] = "Password is incorrect";?>
            <script>
                location = 'sidepassword.php';
                exit;
            </script>
        <?php 
        }else{
            $new = $_POST['new'];
            $confirm = $_POST['confirm'];
            
            $encrypted_password = password_hash($new, PASSWORD_DEFAULT);
            $quertInsert = $connect->query("UPDATE `tbl_agent` SET password='$encrypted_password' WHERE agent_ID='$var' ");
            
            if ($quertInsert) {
                $_SESSION['status'] = "Password Changed Successfully";?>
                <script>
                    location = 'sidepassword.php';
                    exit;
                </script>
                <?php }else{
                $_SESSION['status'] = "Password Failed to Change";?>
                <script>
                    location = 'sidepassword.php';
                    exit;
                </script>
                <?php
            }
        }    
    }
}else {
    $query=$connect->query("SELECT * FROM tbl_user WHERE user_ID='$var'");
    $resquery = $query->fetch_assoc();

    if(isset($_POST['btn_saveChanges'])){
        $current = $_POST['current'];
        if (!password_verify($current, $resquery['password'])) {
            $_SESSION['status'] = "Password is incorrect";?>
            <script>
                location = 'sidepassword.php';
                exit;
            </script>
        <?php 
        }else{
            $new = $_POST['new'];
            $confirm = $_POST['confirm'];
            
            $encrypted_password = password_hash($new, PASSWORD_DEFAULT);
            $quertInsert = $connect->query("UPDATE `tbl_user` SET password='$encrypted_password' WHERE user_ID='$var' ");
            
            if ($quertInsert) {
                $_SESSION['status'] = "Password Changed Successfully";?>
                <script>
                    location = 'sidepassword.php';
                    exit;
                </script>
                <?php }else{
                $_SESSION['status'] = "Password Failed to Change";?>
                <script>
                    location = 'sidepassword.php';
                    exit;
                </script>
                <?php
            }
        }    
    }
}
