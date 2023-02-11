<?php
include_once 'header.php';
include('dbconfig.php');
?>

<style>
    <?php include 'css/propertycart.css' ?>
</style>

<?php
$var = $_SESSION['user_ID'];
$x = 0;
$sql = "SELECT 
    tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.trans_ID,
    tbl_transaction.property_ID
     
    FROM ((tbl_transaction
    INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
    INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) WHERE tbl_transaction.agent_ID = '$var' AND status_Trans = 'Pending'";
$result = mysqli_query($connect, $sql);

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <?php if (mysqli_num_rows($result) != 0) {?>
                <section class="topsection d-flex justify-content-center align-items-center">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-0">
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $x++;
                                if ($x == 1) {
                                    $classname = 'carousel-item active';
                                } else {
                                    $classname = 'carousel-item';
                                }

                                $propID1 = $row['property_ID'];
                                $sql4 = "SELECT * FROM `tbl_show` WHERE property_ID='$propID1'";
                                $result4 = mysqli_query($connect, $sql4);
                                $row4 = mysqli_fetch_assoc($result4);
                            ?>
                                <!-- Carousel for Cards every pending properties -->
                                <div class="<?php echo $classname; ?>">
                                    <div class="card rounded">
                                        <div class="row g-0">
                                            <div class="property-img col-7">
                                                <?php echo '<img class="pe-3" src="data:image/jpeg;base64,' . base64_encode($row4['propertyImg']) . '"alt="First slide" width="380" height="400">'; ?>
                                            </div>
                                            <div class="col">
                                                <div class="card-body container-fluid d-flex flex-column">
                                                    <h5 class="card-text"><?php echo $row['title'] ?></h5>
                                                    <p class="card-text">Agent: <?php echo $row['lName'] . ', ' . $row['fName'] ?></p>
                                                    <p class="card-text"><small class="text-muted"><?php echo $row['location'] ?></small></p>
                                                    <form method="POST" onsubmit="return confirm('Are you sure you want to Accept the Transaction')" action="propertycart.php" class="property-name-post container-fluid d-flex flex-column">
                                                        <input type="hidden" id="hide" name="hide" value="<?php echo $row['trans_ID'] ?>">
                                                        <button type="submit" id="btn_Accept" name="btn_Accept" class="btn btn-accept">Accept</button>
                                                        <button type="submit" id="btn_Cancel" name="btn_Cancel" class="btn btn-reject">Reject</button>
                                                    </form>
                                                    <!-- <button type="button" class="btn-reject btn">Cancel</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon me-5" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon ms-5" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </section>
            <?php }else{?>
                <section class="topsection d-flex justify-content-center align-items-center">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-0">
                            <!-- Carousel for Cards every pending properties -->
                            <div class="<?php echo $classname; ?>">
                                <div class="card rounded">
                                    <div class="row g-0">
                                        <div class="property-img col-7">
                                            <img class="pe-3" src="https://t3.ftcdn.net/jpg/01/82/24/68/360_F_182246882_zzaoBR9ei0vAidaau2s66z8Wi4WPlalb.jpg" alt="First slide" width="380" height="400">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <button class="carousel-control carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon me-5" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon ms-5" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
            <?php } ?>
            </div>
            
            <div class="col-6">
                <section class="table-section container-fluid d-flex flex-column justify-content-center align-items-center">
                    <div class="topsearchbar">
                        <form action="propertycart.php" method="POST" role="search" id="form">
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
                    </div>
                    <div class="property-table table-responsive">
                        <table class="table align-middle mb-0 p-2 table-dark table-hover table-borderless rounded">
                            <thead class="">
                                <tr>
                                    <th>Property Info</th>
                                    <th>Agent</th>
                                    <th>Feedback</th>
                                    <th>Rate</th>
                                    <th>Transaction</th>
                                    <th>Confirm</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x = 0;
                                $sql1 = "SELECT 
                tbl_agent.fName ,tbl_agent.lName, tbl_property.title, tbl_property.location, tbl_transaction.trans_Date, tbl_transaction.property_id,
                tbl_transaction.status_Trans, tbl_transaction.trans_Date, tbl_transaction.doneDate, tbl_transaction.rate, tbl_transaction.feedback
                
                FROM ((tbl_transaction
                INNER JOIN tbl_agent ON tbl_transaction.agent_ID = tbl_agent.agent_ID)
                INNER JOIN tbl_property ON tbl_transaction.property_ID = tbl_property.property_ID) WHERE tbl_transaction.agent_ID= '$var' AND status_Trans = 'Done' OR status_Trans = 'Cancelled' OR status_Trans = 'Sold' OR status_Trans = 'Rejected'";
                                $result1 = mysqli_query($connect, $sql1);

                                if (mysqli_num_rows($result1) != 0) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $propID = $row1['property_ID'];
                                        $sql2 = "SELECT * FROM `tbl_show` WHERE property_ID ='$propID'";
                                        $result2 = mysqli_query($connect, $sql2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center text-wrap">
                                                    <?php //echo '<img  src="data:image/jpeg;base64,'.base64_encode($row2['propertyImg']).'" style="width: 170px; height: 130px" class="">'; 
                                                    ?>
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1"><?php echo $row1['title'] ?></p>
                                                        <p class="text-muted mb-0"><?php echo $row1['location'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="fw-normal mb-1"><?php echo $row1['lName'] . ', ' . $row1['fName'] ?></p>
                                            </td>
                                            <td>
                                                <span class="badge"><?php echo $row1['feedback'] ?></span>
                                            </td>
                                            <td>
                                                <span class="badge"><?php echo $row1['rate'] ?></span>
                                            </td>
                                            <td>
                                                <span class="badge"><?php echo $row1['trans_Date'] ?></span>
                                            </td>
                                            <td>
                                                <span class="badge"><?php echo $row1['doneDate'] ?></span>
                                            </td>
                                            <td>
                                                <span class="badge"><?php echo $row1['status_Trans'] ?></span>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php
    include_once 'footer.php';

    if (isset($_POST['btn_Accept'])) {
        $hidden = $_POST['hide'];

        $sql3 = "UPDATE tbl_transaction SET `status_Trans`='Sold' WHERE trans_ID='$hidden'";
        $result3 = mysqli_query($connect, $sql3);

        if (isset($result3)) {
    ?>
            <script>
                alert('Successfully Sold');
                location = 'propertycart.php';
                exit;
            </script>
        <?php } else { ?>
            <script>
                alert('Transaction Failed');
                location = 'propertycart.php';
                exit;
            </script>
        <?php
        }
    }

    if (isset($_POST['btn_Cancel'])) {
        $hidden = $_POST['hide'];

        $sql3 = "UPDATE tbl_transaction SET `status_Trans`='Rejected' WHERE trans_ID='$hidden'";
        $result3 = mysqli_query($connect, $sql3);

        if (isset($result3)) {
        ?>
            <script>
                alert('Successfully Cancelled');
                location = 'propertycart.php';
                exit;
            </script>
        <?php } else { ?>
            <script>
                alert('Canceling Failed');
                location = 'propertycart.php';
                exit;
            </script>
    <?php
        }
    }
    ?>