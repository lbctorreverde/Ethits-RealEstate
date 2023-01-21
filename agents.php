<?php
include_once 'header.php';

include ('dbconfig.php');
?>

<style>
    <?php include 'css/agents.css'; ?>
</style>


<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1>Find your agent on this page</h1>
</section>

<form action="agentscode.php" method="POST" role="search" id="form">
    <input type="search" id="query" name="searchName" placeholder="Search..." aria-label="Search through site content">
    <?php
        if ($_SESSION['searchName'] == "") {
            
            $_SESSION['searchName'] = $database->getReference('agentInfo')->orderByChild("lastName")->getValue();
        }
    ?>
    <button type="submit" name="btn_search" class="searchbtn"><svg viewBox="0 0 1024 1024"></svg></button>
    <!-- Filter Button -->
    <button type="button" class="filter-btn btn btn-dark" data-bs-toggle="modal" data-bs-target='#exampleModal' onclick="myModal.show()">Filter</button>
</form>

<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4>Bataan Agents</h4>
        <?php
            $x = 0;
            foreach ($_SESSION['searchName'] as $key => $value) {
                $x++;
            }
        ?>
        <p><b><?php echo $x?></b> Results</p>
    </div>
    <div class="agentslist-panel">
        <?php 


            foreach ($_SESSION['searchName'] as $key => $row) {
                ?>
                    <!-- CARD FOR EACH AGENT PAR-->
                    <div class="agentcard row g-0 mt-2 shadow">
                        <div class="col-md-2">
                            <?php
                                $user = $auth->getUser($row['Uniquekey']); 

                                if ($user->photoUrl != NULL) {
                                    ?>
                                        <img src="<?=$user->photoUrl?>" class="img-fluid rounded-start" alt="..." width="150" height="150" />
                                    <?php
                                }else {
                                    ?>
                                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150"/>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <?php ?>
                                <!-- Paiba nalang, sa notfound.php pa redirect nya eh -->
                                <a class="text-decoration-none text-reset" onclick="window.location.href='notfound.php';"><?php echo $row['lastName'].", ".$row['firstName']." ".substr($row['midName'], 0, 1)."."?></a>
                                <p class="card-text text-muted">Real Estate Professional<br>
                                    <?php $getdata = $database->getReference('agentInfo')->getChild($row['Uniquekey'])->getValue();
                                    echo $row['agency']." - ".$getdata['str'].", ".$getdata['brgy'].", ".$getdata['city'].", Bataan"?>
                                </p>

                                <p class="card-title text-muted">Contact: </p>
                                <p class="card-text"><small class="text-muted lh-sm"><?php echo $row['contactNo']?></small></p>
                                <?php 
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
        

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form  action="agentscode.php" method="POST" class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container-fluid d-flex flex-column modal-body justify-content-center">
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder=" " style="width: 32vh;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Agency</label>
                        <input type="text" class="form-control" name="agency" placeholder=" " style="width: 32vh;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">City</label>
                        <input type="text" class="form-control" name="loccity" placeholder=" " style="width: 32vh;">
                    </div>
                    <!-- <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Barangay</label>
                        <input type="text" class="form-control" name="locbrngy" placeholder=" " style="width: 32vh;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="inputEmail4" class="form-label">Street</label>
                        <input type="text" class="form-control" name="locstr" placeholder=" " style="width: 32vh;">
                    </div> -->
                    <button type="submit" name="btn_filter" class="btn btn-dark mt-3">Apply</button>
            </div>
        </div>
    </div>
        </form>
</div>

<script type="text/javascript">
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
</script>

<?php
$_SESSION['searchName'] = "";
$_SESSION['agency'] = "";
$_SESSION['locC'] = "";
?>