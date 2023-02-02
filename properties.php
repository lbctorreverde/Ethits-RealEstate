<?php
include_once 'header.php';
include('dbconfig.php');
?>

<style>
    <?php include 'css/properties.css' ?>
</style>

<section class="topsection d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-house-door-fill"></i>
    <span class="display-5 mb-4">Listed properties</span>
    <form action="propertiescode.php" method="POST" role="search" id="form">
        <input type="search" id="query" name="searchProp" placeholder="Search..." aria-label="Search through site content">
        <?php
        $_SESSION['agentselected'] = "";
        ?>
        <select class="form-select" name="filter" id="filter" required>
            <option value="Title">Title</option>
            <option value="Bath">Bathroom</option>
            <option value="Bed">Bedroom</option>
            <option value="Sf">Special Features</option>
            <option value="Loc">Location</option>
        </select>
        <span class="vr me-3"></span>
        <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg></button>
    </form>
</section>

<section class="properties-section">
    <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php
                
                    $query = "SELECT * FROM tbl_property";
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
                        <form method="POST" action="properties.php" class="property-name-post d-flex form-control text-start">
                            <input type="hidden" id="hide" name="hide" value="<?php echo $rowShow['agent_ID'] ?>">
                            <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide">
                                <h5 class="card-title"><?php echo $rowShow['title']; ?></h5>
                            </button>
                        </form>
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
                        <?php
                        if (isset($_SESSION['user_ID'])) {
                            $var = $_SESSION['user_ID'];
                        }
                        ?>
                        <?php
                            if (!isset($_SESSION['user_ID'])) {?>
                                <div class="card-footer text-muted" style="text-align: center;">
                                    <button onclick="window.location.href='login.php';" >Buy</button>
                                </div>
                            <?php }else{
                                $var = $_SESSION['user_ID'];?>
                        <form method="POST" onsubmit="return confirm('<?php echo 'Are you sure you want to buy '.$rowShow['title'];?>');" action="propertiescode.php" class="property-name-post d-flex form-control text-start">
                            <input type="hidden" id="user" name="user" value="<?php echo $var?>">
                            <input type="hidden" id="agent" name="agent" value="<?php echo $rowShow['agent_ID'] ?>">
                            <input type="hidden" id="property" name="property" value="<?php echo $rowShow['property_ID'] ?>">
                            <div class="card-footer text-muted" style="text-align: center;">
                                <button type="submit" id="btn_hide1" name="btn_hide1" class="btn btn-light" >Buy</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>

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
?>