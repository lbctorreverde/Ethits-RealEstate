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
                        <a href="editcontract.php" class="nav-link align-middle px-0">
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
                    <div id="divTitle" class="text-top text-center text-light fs-2">Sold Properties</div>
            <br><br>
            <section class="properties-section">
                <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-2">
                        <?php
                            $uid = $_SESSION['verified_user_id'];
                            $loop = $database->getReference('soldProperty')->getChild($uid)->getValue();
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
                                            <span><b>Land Size:&nbsp;</b><?php echo $row['lot']; ?>m²</span>&nbsp;&nbsp;&nbsp;
                                            <span ><b >Status:&nbsp;</b><span class="text-success"><?php echo $row['stats']; ?></span></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bathroom:&nbsp;</b> <?php echo $row['lot']; ?>&nbsp;&nbsp;&nbsp;
                                            <b>Bedroom:&nbsp;</b> <?php echo $row['lot']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Garage:&nbsp;</b> <?php echo $row['lot']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

