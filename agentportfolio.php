<?php
include_once 'header.php';

include('dbconfig.php');
?>

<style>
    <?php include 'css/agentportfolio.css'; ?>
</style>

<section class="container-fluid d-flex align-items-center " id="topsection">
    <?php
    include('dbconfig.php');
    if (!isset($_SESSION['agentselected'])) {
        $_SESSION['status']  = "Pick an agent/properties";
        header('Location: index.php');
        exit();
    }
    $var = $_SESSION['agentselected'];
    $sqlAgent = "SELECT * FROM tbl_agent WHERE agent_ID = '$var'";
    $resAgent= mysqli_query($connect, $sqlAgent);
    $rowAgent = mysqli_fetch_assoc($resAgent);

    if ($rowAgent['displayImg']) {
    ?>
        <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($rowAgent['displayImg']).'" class="agent-picture" alt="Agents profile picture">'; ?>
    <?php
    } else {
    ?>
        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="agent-picture" alt="Agent's profile picture">
    <?php
    }
    ?>
    <div class="container-fluid">
        <div class="box" style="height:200px">
            <div class="toptext">
                <h1 class="agent-name"><?php echo $rowAgent['lName'].", ".$rowAgent['fName']." ".substr($rowAgent['mName'], 0, 1)."."?></h1>
                <h3><small class="text-muted">Real Estate Professional</small></h3>
            </div>

            <div class="container">
                <div class="row align-items-start">
                    <div class="col mb-3">
                        <i class="bi bi-building-fill me-2"></i>
                        <span><?php echo $rowAgent['agency']?></span>
                    </div>
                    <div class="col text-end">
                        <i class="bi bi-envelope-at-fill me-2"></i>
                        <span><?php echo $rowAgent['email']?></span>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span>
                            <?php echo $rowAgent['agency']." - ".$rowAgent['str'].", ".$rowAgent['brgy'].", ".$rowAgent['city'].", Bataan"?>
                        </span>
                    </div>
                    <div class="col text-end">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <span><?php echo $rowAgent['contactNo']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="d-flex flex-column justify-content-center align-items-center" id="midsection">
    <h1 class="display-4 text-light pb-5">Properties for sale</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
                $x = 0;
                // $sqll = "SELECT * FROM tbl_property WHERE agent_ID = '$var'";
                // $sel= mysqli_query($connect, $sqll);
                // $rowl = mysqli_fetch_assoc($sel);
                //$varr = $rowl['property_ID'];

                $sqlCa = "SELECT * FROM tbl_property WHERE agent_ID = '$var'";
                $resCa= mysqli_query($connect, $sqlCa);
                if (mysqli_num_rows($resCa)  != 0) {
                                while ($rowCa = mysqli_fetch_array($resCa)) {
                                    $x++;
                                    if ($x == 1) {
                                        $classname = 'carousel-item active';
                                    } else {
                                        $classname = 'carousel-item';
                                }

                                    $agentId = $rowCa['property_ID'];
                                    $sq = "SELECT * FROM tbl_show WHERE property_ID = '$agentId'";
                                    $showId= mysqli_query($connect, $sq);
                                    $rowll = mysqli_fetch_assoc($showId);
                            ?>
                                <div class="<?php echo $classname;?>">
                                
                                    <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($rowll['propertyImg']).'" class="d-block w-100" height="550" alt=" ">'; ?>
                                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                                        <p class="text-center text-light fw-bold"><?php echo $rowCa['title'] ?></p>
                                        <p class="text-center text-light"><?php echo $rowCa['location'] ?></p>
                                    </div>
                                </div>
                        <?php }?>
                <?php
                } else {?>
                <div class="<?php echo $classname;?>">
                    <img src="https://t3.ftcdn.net/jpg/01/82/24/68/360_F_182246882_zzaoBR9ei0vAidaau2s66z8Wi4WPlalb.jpg" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold">Empty</p>
                        <p class="text-center text-light">Empty</p>
                        </div>
                    </div>
        <?php }?>
        </div>
        <div class="d-flex align-middle">
            <button class="carousel-control-prev align-middle" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
</section>

<section class="d-flex flex-column justify-content-center align-items-center" id="endsection">
    <h1 class="display-4 text-light pb-5">Sold Properties</h1>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
                $a = array();
                $x = 0;
                $sqlCa = "SELECT * FROM tbl_property WHERE agent_ID = '$var' AND statusProperty = 'Sold' ";
                $resCa= mysqli_query($connect, $sqlCa);
                if (mysqli_num_rows($resCa)  == 0) {?>
                    <div class="<?php echo $classname;?>">
                    <img src="https://t3.ftcdn.net/jpg/01/82/24/68/360_F_182246882_zzaoBR9ei0vAidaau2s66z8Wi4WPlalb.jpg" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold">Empty</p>
                        <p class="text-center text-light">Empty</p>
                        </div>
                    </div>
                <?php
                } else {
                    while ($rowCa = mysqli_fetch_array($resCa)) {
                        $x++;
                        if ($x == 1) {
                            $classname = 'carousel-item active';
                        } else {
                            $classname = 'carousel-item';
                    }
    
                        $agentId = $rowCa['property_ID'];
                        $sq = "SELECT * FROM tbl_show WHERE property_ID = '$agentId'";
                        $showId= mysqli_query($connect, $sq);
                        $rowll = mysqli_fetch_assoc($showId);
                ?>
                    <div class="<?php echo $classname;?>">
                    
                        <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($rowll['propertyImg']).'" class="d-block w-100" height="550" alt=" ">'; ?>
                        <div class="info-bottom rounded-bottom pt-3 pb-2">
                            <p class="text-center text-light fw-bold"><?php echo $rowCa['title'] ?></p>
                            <p class="text-center text-light"><?php echo $rowCa['location'] ?></p>
                        </div>
                    </div>
            <?php }}?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <span class="pb-5"></span>
</section>

<?php
include_once 'footer.php';
?>