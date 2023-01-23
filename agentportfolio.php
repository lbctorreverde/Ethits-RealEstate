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
        $_SESSION['status']  = "Pick an agent";
        header('Location: agents.php');
        exit();
    }

    $keys = $_SESSION['agentselected'];
    $user = $auth->getUser($keys);

    if ($user->photoUrl != NULL) {
    ?>
        <img src="<?= $user->photoUrl ?>" class="agent-picture" alt="Agent's profile picture" />
    <?php
    } else {
    ?>
        <img src="img/121vrq3gasfdg5.jpg" class="agent-picture" alt="Agent's profile picture">
    <?php
    }
    ?>
    <div class="container-fluid">
        <?php 
            $keys = $_SESSION['agentselected'];
            $row = $database->getReference('agentInfo')->getChild($_SESSION['agentselected'])->getValue();
            if ($row > 0) {
        ?>
        <div class="box" style="height:200px">
            <div class="toptext">
                <h1 class="agent-name"><?php echo $row['lastName'].", ".$row['firstName']." ".substr($row['midName'], 0, 1)."."?></h1>
                <h3><small class="text-muted">Real Estate Professional</small></h3>
            </div>

            <div class="container">
                <div class="row align-items-start">
                    <div class="col mb-3">
                        <i class="bi bi-building-fill me-2"></i>
                        <span><?php echo $row['agency']?></span>
                    </div>
                    <div class="col text-end">
                        <i class="bi bi-envelope-at-fill me-2"></i>
                        <span><?php echo $row['email']?></span>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span>
                            <?php $getdata = $database->getReference('agentInfo')->getChild($row['Uniquekey'])->getValue();
                            echo $row['agency']." - ".$getdata['str'].", ".$getdata['brgy'].", ".$getdata['city'].", Bataan"?>
                        </span>
                    </div>
                    <div class="col text-end">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <span><?php echo $row['contactNo']?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</section>

<section class="d-flex flex-column justify-content-center align-items-center" id="midsection">
    <h1 class="display-4 text-light pb-5">Properties for sale</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
                $a = array();
                $x = 0;
                $loop1 = $database->getReference('propertyInfo/'.$keys)->getValue();
                if (!isset($loop1)) {?>
                    <div class="<?php echo $classname;?>">
                    <img src="https://t3.ftcdn.net/jpg/01/82/24/68/360_F_182246882_zzaoBR9ei0vAidaau2s66z8Wi4WPlalb.jpg" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold">Empty</p>
                        <p class="text-center text-light">Empty</p>
                        </div>
                    </div>
                <?php
                } else {
                foreach ($loop1 as $var => $row1) {
                    $x++;
                    if ($x == 1) {
                        $classname = 'carousel-item active';
                    } else {
                        $classname = 'carousel-item';
                }
            ?>
                <div class="<?php echo $classname;?>">
                    <img src="<?php echo $row1['propertyImg'];?>" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold"><?php echo $row1['title'] ?></p>
                        <p class="text-center text-light"><?php echo $row1['location'] ?></p>
                    </div>
                </div>
        <?php }}?>
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
                $loop1 = $database->getReference('soldProperty/'.$keys)->getValue();
                if (!isset($loop1)) {?>
                    <div class="<?php echo $classname;?>">
                    <img src="https://t3.ftcdn.net/jpg/01/82/24/68/360_F_182246882_zzaoBR9ei0vAidaau2s66z8Wi4WPlalb.jpg" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold">Empty</p>
                        <p class="text-center text-light">Empty</p>
                        </div>
                    </div>
                <?php
                } else {
                foreach ($loop1 as $var => $row1) {
                    $x++;
                    if ($x == 1) {
                        $classname = 'carousel-item active';
                    } else {
                        $classname = 'carousel-item';
                }
            ?>
                <div class="<?php echo $classname;?>">
                    <img src="<?php echo $row1['propertyImg'];?>" class="d-block w-100" height="550" alt=" ">
                    <div class="info-bottom rounded-bottom pt-3 pb-2">
                        <p class="text-center text-light fw-bold"><?php echo $row1['title'] ?></p>
                        <p class="text-center text-light"><?php echo $row1['location'] ?></p>
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