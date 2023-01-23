<?php
use Kreait\Firebase\Value\Email;

include_once 'header.php';?>

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
                        <a href="editprofile.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editprofileUpload.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Documents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editproperty.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Properties</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="soldproperty.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Contract Done</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="content-form col py-3">
            <div>
                <form action="editpropertycode.php" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                    <?php 
                        if(isset($_SESSION['status']))
                        {
                            echo "<p class='alert alert-success'>".$_SESSION['status']."</p>";
                            unset($_SESSION['status']);
                        }

                        echo $_SESSION['uploadImg'];
                    ?>
                    <div id="divTitle" class="text-top text-center text-light fs-2">Properties</div>
                    <div id="idstyle" style="pointer-events: none;" class="row">
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-9 p-2 g-col">
                                    <label for="inputEmail4" class="form-label">Property Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title here.." required>
                                </div>
                                <div class="p-2 g-col col-lg-3">
                                    <label for="inputState" class="form-label">Status</label>
                                    <select class="form-select" name="stats" id="stats" required>
                                        <option value="Active">Active</option>
                                        <option value="Sold">Sold</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 p-2 g-col">
                                    <label for="inputEmail4" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="location" id="location" placeholder="Enter Address here..." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="row">
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Bathroom</label>
                                        <input type="number" class="form-control" name="bath" id="bath" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Bedroom</label>
                                        <input type="number" class="form-control" name="bed" id="bed" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Lot Size (m²)</label>
                                        <input type="text" class="form-control" name="lot" id="lot"  required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-3 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Basement</label>
                                        <select class="form-select" name="basement" id="basement" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Garage</label>
                                        <select class="form-select" name="garage" id="garage" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Special Features</label>
                                        <input type="text" class="form-control" name="sf" id="sf" placeholder="Enter special features..">
                                    </div>
                                </div> 
                            </div>
                            <div class="col">
                                <label for="inputEmail4" class="form-label">Property Image</label>
                                <input type="file" name="propertyImg" class="form-control" id="propertyImg" />
                            </div>
                        </div>
                    <div class="d-flex col-12 justify-content-center">
                        <button type="submit" onclick="uploadImage()" name="btn_saveChangesAgent" id="btn_saveChangesAgent" class="btn btn-dark" style="display: none;">Save Property</button>
                    </div>
                </form>
            <div class="d-flex col-12 justify-content-center">
                <button name="btn_Edit" id="btn_Edit" onclick="setDisable()" class="btn btn-dark" style="display: block;">Add Property</button><br>
                <button name="btn_Cancel" id="btn_Cancel" onclick="window.location.href='editproperty.php';" class="btn btn-dark" style="display: none;">Cancel</button>
            </div>
            <br><br>
            <section class="properties-section">
                <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        <?php
                            $uid = $_SESSION['verified_user_id'];
                            $loop = $database->getReference('propertyInfo')->getChild($uid)->getValue();
                            if (isset($loop)) {
                            foreach ($loop as $key => $row) {
                            ?>
                        <div class="col">
                            <div class="card ">
                                <img src="<?php echo $row['propertyImg']; ?>" class="card-img-top" alt="...">
                                <div class="card-body shadow">
                                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <span class="icon-livingsize"></span>
                                        <li class="list-group-item">
                                            <span><b>Land Size:</b>&nbsp;<?php echo $row['lot']; ?>m²</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span ><b >Status:&nbsp;</b><span class="text-success"><?php echo $row['stats']; ?></span></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bathroom:&nbsp;</b> <?php echo $row['lot']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Bedroom:&nbsp;</b> <?php echo $row['lot']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Garage:&nbsp;</b> <?php echo $row['lot']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Basement:&nbsp;</b> <?php echo $row['lot']; ?>
                                        </li>
                                        <li class="list-group-item"><b>Special Features:&nbsp;</b><?php echo $row['sf']; ?></li>
                                        <li class="list-group-item text-muted">
                                            <p class="card-text"><small class="text-muted"><?php echo $row['location']; ?></small></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php
    if (isset($_SESSION['uploadImg'])) {
        $up = $_SESSION['uploadImg'];
    }

    if (isset($_SESSION['verified_user_id'])) {
        $id = $_SESSION['verified_user_id'];
    }
?>
<script>
    //To make inputs editable 
    function setDisable(){
        document.getElementById("divTitle").innerHTML = "Add Property";
        document.getElementById("btn_Cancel").style.display = "block";
        document.getElementById("idstyle").style.pointerEvents = 'auto';
        document.getElementById("btn_saveChangesAgent").style.display = "block";
        document.getElementById("btn_Edit").style.display = "none";
        document.getElementById("divConfirm").style.display = "block";
    }

</script>

