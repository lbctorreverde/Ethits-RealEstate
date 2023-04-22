<?php
include_once 'header.php';
include "dbconfig.php";
?>

<style>
    <?php include 'css/editprofile.css' ?>
</style>

<script>
</script>
<script>
    //To make inputs editable 
    function setDisabled(){
        document.getElementById("divTitle").innerHTML = "Add Property";
        document.getElementById("btn_Cancel").style.display = "block";
        document.getElementById("idstyle").style.pointerEvents = 'auto';
        document.getElementById("btn_saveChangesAgent").style.display = "block";
        document.getElementById("btn_Edit").style.display = "none";
        document.getElementById("divConfirm").style.display = "block";
    }
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
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Add Properties</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="content-form col py-3">
            <div>
                <form action="editpropertycode.php" method="POST" class="container-fluid row g-3" id="signup-form" enctype="multipart/form-data">
                    <div id="divTitle" class="text-top text-center text-light fs-2">Properties</div>
                    <br>
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
                            <div class="row">
                                <div class="col-sm-4 p-2 g-col">
                                    <label for="inputEmail4" class="form-label">Property Type</label>
                                    <select class="form-select" name="ptype" id="ptype" required>
                                        <option value="" selected disabled>Select Style</option>
                                        <option value="Bungalow">Bungalow</option>
                                        <option value="Contemporary">Contemporary</option>
                                        <option value="Cottage">Cottage</option>
                                        <option value="Duplex">Duplex</option>
                                        <option value="Modern">Modern</option>
                                        <option value="Rowhouse">Rowhouse</option>
                                        <option value="Townhouse">Townhouse</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 p-2 g-col">
                                    <label for="inputEmail4" class="form-label">Special Features</label>
                                    <input type="text" class="form-control" name="sf" id="sf" placeholder="Enter property type..">
                                </div>
                                <div class="col-sm-4 p-2 g-col">
                                    <label for="inputEmail4" class="form-label">Price</label>
                                    <input type="number" step=0.25 min=0 class="form-control" name="price" id="price">
                                </div>
                            </div>
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
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Basement</label>
                                        <select class="form-select" name="basement" id="basement" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Garage</label>
                                        <select class="form-select" name="garage" id="garage" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 p-2 g-col">
                                        <label for="inputEmail4" class="form-label">Floor Area (m²)</label>
                                        <input type="text" class="form-control" name="area" id="area"  required>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-5">
                            <div class="row">
                                <div class="card" style="width: 37.5rem; left:2%;">
                                    <div class="mx-auto"> 
                                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="Paris" style="float:left;width:100%;height:100%;object-fit:cover;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col">
                                    <br><label for="inputEmail4" class="form-label">Property Image</label>
                                    <input type="file" name="propertyImg[]" class="form-control" id="propertyImg" multiple required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex col-12 justify-content-center">
                        <button type="submit" name="btn_saveChangesAgent" id="btn_saveChangesAgent" class="btn btn-dark" style="display: none;">Save Property</button>
                    </div>
                </form>
            <div class="d-flex col-12 justify-content-center">
                <button name="btn_Edit" id="btn_Edit" onclick="setDisabled()" class="btn btn-dark" style="display: block;">Add Property</button>
                <button name="btn_Cancel" id="btn_Cancel" onclick="window.location.href='editproperty.php';" class="btn btn-dark" style="display: none;">Cancel</button>
            </div>
            <br><br>
            
            <section class="properties-section">
                <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                        <?php
                                try {
                                $var = $_SESSION['user_ID'];
                                $query = "SELECT * FROM tbl_property WHERE agent_ID = '$var'";
                                $classadd = 0;
                                $result = mysqli_query($connect, $query);
                                while ($rowShow = mysqli_fetch_array($result)) {
                                $classadd++;
                            ?>
                        <div class="col">
                            <div class="card ">
                                        <?php
                                            $var1 = $rowShow['property_ID'];
                                            $picShow = "SELECT * FROM tbl_show WHERE property_ID = '$var1'";
                                            $resShow = mysqli_query($connect, $picShow);
                                            $a = array();
                                            $x = 0;
                                            while ($pic = mysqli_fetch_array($resShow)) {
                                                $x++;
                                                if ($x == 1) {
                                                    $classname = 'carousel-item active';
                                                } else {
                                                    $classname = 'carousel-item';
                                                }
                                        ?>
                                        <div class="<?php echo $classname;?>">
                                            <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($pic['propertyImg']).'" class="d-block w-100" alt="First slide">'; ?>
                                        </div>
                                        <?php }?>
                                <div class="card-body shadow">
                                    <h5 class="card-title"><?php echo $rowShow['title']; ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <span class="icon-livingsize"></span>
                                        <li class="list-group-item">
                                            <span><b>Land Size:</b>&nbsp;<?php echo $rowShow['lotSize']; ?>m²</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span ><b >Status:&nbsp;</b><span class="text-success"><?php echo $rowShow['statusProperty']; ?></span></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bathroom:&nbsp;</b> <?php echo $rowShow['bathroom']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Bedroom:&nbsp;</b> <?php echo $rowShow['bedroom']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Garage:&nbsp;</b> <?php echo $rowShow['garage']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Basement:&nbsp;</b> <?php echo $rowShow['basement']; ?>
                                        </li>
                                        <li class="list-group-item"><b>Special Features:&nbsp;</b><?php echo $rowShow['specialFeatures']; ?></li>
                                        <li class="list-group-item text-muted">
                                            <p class="card-text"><small class="text-muted"><?php echo $rowShow['location']; ?></small></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php }}
                        catch (\Throwable $th) {
                            die();
                        }?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<footer id="sticky-footer" class="sticky-footer flex-shrink-0 py-4">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>




