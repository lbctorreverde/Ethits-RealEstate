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
        if ($_SESSION['searchProp'] == "") {
            $_SESSION['searchProp'] = $database->getReference('propertyInfo')->getValue();
        }
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
            $loop1 = $database->getReference('propertyInfo')->getChildKeys();
            foreach ($loop1 as $x => $y) {
                $loop = $database->getReference('propertyInfo/' . $y)->getValue();
                if (isset($loop)) {
                    foreach ($loop as $key => $row) {
            ?>
                        <div class="col">
                            <div class="card ">
                                <img src="<?php echo $row['propertyImg']; ?>" class="card-img-top" alt="...">
                                <div class="card-body shadow">
                                    <form method="POST" action="propertiesC.php" class="property-name-post d-flex form-control text-start">
                                        <input type="hidden" id="hide" name="hide" value="<?php echo $y; ?>">
                                        <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide">
                                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                        </button>
                                    </form>
                                    <ul class="list-group list-group-flush">
                                        <span class="icon-livingsize"></span>
                                        <li class="list-group-item">
                                            <span><b>Land Size:</b>&nbsp;<?php echo $row['lot']; ?>m²</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span><b>Status:&nbsp;</b><span class="text-success"><?php echo $row['stats']; ?></span></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bathroom:&nbsp;</b> <?php echo $row['bath']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Bedroom:&nbsp;</b> <?php echo $row['bed']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Garage:&nbsp;</b> <?php echo $row['garage']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Basement:&nbsp;</b> <?php echo $row['basement']; ?>
                                        </li>
                                        <li class="list-group-item"><b>Special Features:&nbsp;</b><?php echo $row['sf']; ?></li>
                                        <li class="list-group-item text-muted">
                                            <p class="card-text"><small class="text-muted"><?php echo $row['location']; ?></small></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } ?>
        </div>
    </div>
</section>