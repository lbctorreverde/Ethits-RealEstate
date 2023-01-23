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
    <form action="agentscode.php" method="POST" role="search" id="form">
        <input type="search" id="query" name="searchName" placeholder="Search..." aria-label="Search through site content">

        <button type="submit" name="btn_search" class="searchbtn"><svg viewBox="0 0 1024 1024"></svg></button>
        <!-- Filter Button -->
        <button type="button" class="filter-btn btn btn-dark" data-bs-toggle="modal" data-bs-target='#exampleModal' onclick="myModal.show()">Filter</button>
    </form>
</section>

<section class="properties-section">
    <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php
                $loop1 = $database->getReference('propertyInfo')->getChildKeys();
                foreach($loop1 as $x => $y){
                    $loop = $database->getReference('propertyInfo/'.$y)->getValue();
                    if (isset($loop)) {
                        foreach ($loop as $key => $row) {
                            ?>
            <div class="col">
                <div class="card ">
                    <img src="<?php echo $row['propertyImg']; ?>" class="card-img-top" alt="...">
                    <div class="card-body shadow">
                        <form method="POST" action="propertiesC.php" class="property-name-post d-flex form-control text-start">
                            <!-- Sex? -->
                            <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide"><h5 class="card-title"><?php echo $row['title']; ?></h5></button>
                        </form>
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
            <?php }}}?>
        </div>
    </div>
</section>
