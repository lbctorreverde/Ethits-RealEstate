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
    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

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
    <h1 class="display-3 text-light">Properties for sale</h1>
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
                                <span><b>Land Size:</b><?php echo $row['lot']; ?>m²</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

<section class="d-flex flex-column justify-content-center align-items-center" id="endsection">
    <h1 class="display-3 text-light">Sold Properties</h1>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/5332b1b54b190c.webp" class="d-block w-100" alt="...">
                <div class="rounded-bottom bg-dark pt-3 pb-2 px-2">
                    <p class="text-center text-light fw-bold">L-S-1-201604-11- Acquired Property</p>
                    <p class="text-center text-light">Block 2, Lot 21, Topaz St., EMERALD COAST EXECUTIVE VILLAGE, Brgy. Peas/Duale, Limay, Bataan - Sub</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/d8aaa384a22069.webp" class="d-block w-100" alt="...">
                <div class="rounded-bottom bg-dark pt-3 pb-2 px-2">
                    <p class="text-center text-light fw-bold">Anvaya Cove 2-Storey with Spacious Garden</p>
                    <p class="text-center text-light">SABANG, MORONG, BATAAN,SCTEX, SUBIC TARLAC EXPRESSWAY ,NORTH LUZON EXPRESSWAY MABAYO, MABAYO, MORONG SABANG, MORONG</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/c46482a321a833.webp" class="d-block w-100" alt="...">
                <div class="rounded-bottom bg-dark pt-3 pb-2 px-2">
                    <p class="text-center text-light fw-bold">3 Bedroom House and Lot</p>
                    <p class="text-center text-light">Daang Bilolo, Orion City, Bataan</p>
                </div>
            </div>
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
</section>