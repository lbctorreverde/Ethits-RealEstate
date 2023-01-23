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
        <div class="carousel-indicators mt-auto mb-0">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.wavecity.in/wp-content/uploads/2017/07/shutterstock_297096893.jpg" class="d-block w-100" alt=" ">
                <div class="info-bottom rounded-bottom pt-3 pb-2">
                    <p class="text-center text-light fw-bold">Studio Condo in Avida Towers Ardane, Muntinlupa</p>
                    <p class="text-center text-light">National Road, Muntinlupa, Metro Manila</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x5x880x450/e40a1e75b071ab.webp" class="d-block w-100" alt=" ">
                <div class="info-bottom rounded-bottom pt-3 pb-2">
                    <p class="text-center text-light fw-bold">L-S-1-201604-13- Acquired Property for Sale</p>
                    <p class="text-center text-light">Block 1, Lot 8, Diamond St., EMERALD COAST EXECUTIVE VILLAGE, Brgy. Peas/Duale, Limay, Bataan - Sub</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/1f5120507c8f0c.webp" class="d-block w-100" alt=" ">
                <div class="info-bottom rounded-bottom pt-3 pb-2">
                    <p class="text-center text-light fw-bold">Brand New 3 Bedroom Two Storey House & Lot for Sale in Balanga, Bataan</p>
                    <p class="text-center text-light">GRAND CANYON AVE TENEJERO, BALANGA</p>
                </div>
            </div>
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
    <span class="pb-5"></span>
</section>

<?php
include_once 'footer.php';
?>