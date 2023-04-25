<?php
include_once 'navbarfresh.php';
include 'dbconfig.php';

?>
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
<style>
    .box{
        background-color: white;
        margin-top: 100px;
        width: 580px;
        height: 350px;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
        padding-top: 20px;
        text-align: center;
    }
</style>

<?php 
  if (isset($_SESSION['status'])) {
    echo "<p class='alert alert-success'>" . $_SESSION['status'] . "</p>";
    unset($_SESSION['status']);
    }
?>

<div class="main-div d-flex align-items-center justify-content-center">
    <div class="box">
        <h4>Change Password</h4><hr>
        <div>
            <form method="POST">
                <div style="margin-top: 40px;" class="form-group row">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="new" id="new" placeholder="******" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Confirm Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="confirm" id="confirm" placeholder="******" required>
                            <small id="incorrect" name="incorrect" style="color:red; display:none;">Password entered is different</small>
                        
                        </div>
                    </div>
                    <div class="d-flex col-100 justify-content-center">
                        <input type="checkbox" onclick="showPass()">&nbsp;&nbsp;Show Password
                    </div>
                    <br>
                    <div style="margin-top: 30px;" class="d-flex col-20 justify-content-center">
                        <button type="submit" name="btn_saveChanges" id="btn_saveChanges" class="btn btn-dark" style="display: block;">Confirm</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" class="btn btn-dark" style="display: block;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$email = $_GET['email'];
$query = $connect->query("SELECT email,lName FROM tbl_agent WHERE email='$email'");
$res = $query->fetch_assoc();

if ($query->num_rows) {
    $queryRes=$connect->query("SELECT * FROM tbl_agent WHERE email='$email'");
    $resquery = $queryRes->fetch_assoc();

    if(isset($_POST['btn_saveChanges'])){
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];
        
        $encrypted_password = password_hash($new, PASSWORD_DEFAULT);
        $quertInsert = $connect->query("UPDATE `tbl_agent` SET password='$encrypted_password' WHERE email='$email' ");
        if ($quertInsert) {?>
            <script>
                alert('Password successfully changed');
                //location = 'login.php';
                exit;
            </script>
            <?php }else{?>
            <script>
                alert('Failed to change password');
                location = 'login.php';
                exit;
            </script>
            <?php
        }
    }
}else{
    $queryRes=$connect->query("SELECT * FROM tbl_user WHERE email='$email'");
    $resquery = $queryRes->fetch_assoc();

    if(isset($_POST['btn_saveChanges'])){
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];
        
        $encrypted_password = password_hash($new, PASSWORD_DEFAULT);
        $quertInsert = $connect->query("UPDATE `tbl_user` SET password='$encrypted_password' WHERE email='$email' ");
        
        if ($quertInsert) {?>
            <script>
                alert('Password successfully changed');
                location = 'login.php';
                exit;
            </script>
            <?php }else{?>
            <script>
                alert('Failed to change password');
                location = 'login.php';
                exit;
            </script>
            <?php
        }
    }
}
?>


