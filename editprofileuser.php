<?php include_once 'header.php' ?>

<style>
    <?php include 'css/editprofile.css' ?>
</style>

<script>
    <?php require_once 'js/editprofile.js' ?>
</script>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="sidebar nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Edit Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editcontractUser.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Contract Done</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li> -->
                </ul>
                <hr>
            </div>
        </div>
        <div class="content-form col py-3">
            <div>
                <form action="editprofileusercode.php" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                    <?php 
                        if(isset($_SESSION['status']))
                        {
                            echo "<p class='alert alert-success'>".$_SESSION['status']."</p>";
                            unset($_SESSION['status']);
                        }
                    ?>
                    <div id="divTitle" class="text-top text-center text-light fs-2">Profile</div>
                    <div>
                        <div class="mb-4 d-flex justify-content-center">
                            <?php 
                                include ('dbconfig.php');
                                $uid = $_SESSION['verified_user_id'];
                                $user = $auth->getUser($uid); 

                                if ($user->photoUrl != NULL) {
                                    ?>
                                        <img src="<?=$user->photoUrl?>" style="width: 200px;" />
                                    <?php
                                }else {
                                    ?>
                                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 200px;" />
                                    <?php
                                }
                            
                            ?>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div id="custom1" class="btn btn-dark btn-sm" style="display: none;">
                                <!-- <label class="form-label text-white m-1" for="customFile1">Choose file</label> -->
                                <input type="file" name="dPhoto" class="form-control" id="customFile1" />
                            </div>
                        </div>
                    </div>
                    <?php
                        $getdata = $database->getReference('userInfo')->getChild($_SESSION['verified_user_id'])->getValue();
                        $getdata = $database->getReference('userInfo')->getChild($_SESSION['verified_user_id'])->getChild('location')->getValue();

                        if ($getdata > 0) {
                        ?>
                    
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo $getdata['firstName']?>" placeholder="Enter Firstname here.." readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="mname" value="<?php if ($getdata['midName'] != "") {
                            echo $getdata['midName'];} else {echo "-Empty-";}?>" placeholder="Enter Middlename here.." readOnly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $getdata['lastName']?>" placeholder="Enter Lastname here.." readOnly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="bday" value="<?php if (isset($getdata['bday'])) {
                            echo $getdata['bday'];} else {echo "01/01/1900";}?>" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Sex</label>
                        <select class="form-select" name="sex" id="sex" disabled required>
                            <option value="<?php if ($getdata['sex'] != "") {echo $getdata['sex'];} else {echo "-Empty-";}?>">
                                :<?php if ($getdata['sex'] != "") {echo $getdata['sex'];} else {echo "-Empty-";}?>
                            </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="contact" value="<?php if ($getdata['contactNo'] != "") {
                            echo $getdata['contactNo'];} else {echo "-Empty-";}?>" placeholder="Enter phone number" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">City</label>
                        <select class="form-select" name="city" id="city" disabled required>
                            <option value="<?php if ($getdata['city'] != "") {echo $getdata['city'];} else {echo "-Empty-";}?>">
                                :<?php if ($getdata['city'] != "") {echo $getdata['city'];} else {echo "-Empty-";}?>
                            </option>
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
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Barangay</label>
                        <input type="text" class="form-control" name="brgy" value="<?php if ($getdata['brgy'] != "") {
                            echo $getdata['brgy'];} else {echo "-Empty-";}?>" placeholder="Barangay.." readonly required>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail4" class="form-label">Street</label>
                        <input type="text" class="form-control" name="str" value="<?php if ($getdata['str'] != "") {
                            echo $getdata['str'];} else {echo "-Empty-";}?>" placeholder="1234 Main St" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo $getdata['email']?>" name="email" placeholder="example@gmail.com">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" value="<?php echo $getdata['password']?>" name="password" placeholder="********">
                    </div>
                    <div class="col-md-6" style="display: none;" id="divConfirm">
                            <label for="inputPassword4" class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="passConfirm" id="passConfirm" placeholder="Enter current/old password to proceed update.." required>
                        </div>
                    <div class="col-12">
                    </div>
                    <div class="d-flex col-12 justify-content-center">
                    <button type="submit" name="btn_saveChangesUser" id="btn_saveChangesUser" class="btn btn-dark" style="display: none;">Save Changes</button>
                    </div>
                </form>
                <div class="d-flex col-12 justify-content-center">
                    <button name="btn_Edit" id="btn_Edit" onclick="setDisable()" class="btn btn-dark" style="display: block;">Edit</button>
                    <button name="btn_Cancel" id="btn_Cancel" onclick="window.location.href='editprofileuser.php';" class="btn btn-dark" style="display: none;">Cancel</button>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<script>
    //To make inputs editable 
    function setDisable(){
        let getControl = document.getElementsByClassName("form-control")
        let getSelect = document.getElementsByClassName("form-select")
        document.getElementById("divTitle").innerHTML = "Edit Profile";
        document.getElementById("custom1").style.display = "block";
        document.getElementById("btn_Cancel").style.display = "block";
        document.getElementById("btn_saveChangesUser").style.display = "block";
        document.getElementById("btn_Edit").style.display = "none";
        document.getElementById("divConfirm").style.display = "block";
        for (let input of getControl){
            input.removeAttribute('readonly');
        }
        for (let select of getSelect){
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
    //     document.getElementById("btn_saveChangesUser").style.display = "none";
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
