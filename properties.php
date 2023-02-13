<?php
include_once 'header.php';
include('dbconfig.php');

// Include pagination library file 
include_once 'Pagination.class.php';

// Set some useful configuration 
$baseURL = 'getData.php';
$limit = 6;

// Count of all records 
$query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_property WHERE NOT statusProperty ='Pending' OR statusProperty ='Sold' OR statusProperty ='Reject'"); 
$result  = $query->fetch_assoc(); 
$rowCount= $result['rowNum']; 
 
// Initialize pagination class 
$pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'contentDiv' => 'result',
    'link_func' => 'searchFilter'
);
$pagination =  new Pagination($pagConfig);

$query = $connect->query("SELECT * FROM tbl_property WHERE NOT statusProperty ='Pending' OR statusProperty ='Sold' OR statusProperty ='Reject' LIMIT $limit"); 
?>

<style>
    <?php include 'css/properties.css' ?>
</style>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php
if (isset($_SESSION['verified_user_id'])) {
    $var1 = $_SESSION['verified_user_id'];
    $query1 = "SELECT *  from tbl_user WHERE email = '$var1'";
    $result1 = mysqli_query($connect, $query1);
    $row1 = mysqli_fetch_assoc($result1);
}
?>
<script type="text/javascript">
    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        $('#clear').click(function() {
            $('#pselect').prop('selectedIndex', 0)
            $('#pdate').prop('selectedIndex', 0)
            $('#nearby').prop('selectedIndex', 0)
            $('#city').prop('selectedIndex', 0)
            $('#style').prop('selectedIndex', 0)
            $('#bathBy').prop('selectedIndex', 0)
            $('#bedBy').prop('selectedIndex', 0)
            $('#pmax').prop('selectedIndex', 0)
            $('#pmin').prop('selectedIndex', 0)
            document.getElementById('pmax').value = ''
            document.getElementById('pmin').value = ''
        });

        var keywords = $('#keywords').val();
        var filterBy = $('#city').val();
        var styleBy = $('#style').val();
        var bathBy = $('#bathBy').val();
        var bedBy = $('#bedBy').val();
        var pmaxBy = $('#pmax').val();
        var pminBy = $('#pmin').val();
        var selectBy = $('#pselect').val();
        var dateBy = $('#pdate').val();
        var nearBy = $('#nearby').val();



        $('#nearby').click(function() {
            $('#pselect').prop('selectedIndex', 0)
            $('#pdate').prop('selectedIndex', 0)
        });

        $('#pdate').click(function() {
            $('#pselect').prop('selectedIndex', 0)
            $('#nearby').prop('selectedIndex', 0)
        });

        $('#pselect').click(function() {
            $('#pdate').prop('selectedIndex', 0)
            $('#nearby').prop('selectedIndex', 0)
        });


        $.ajax({
            type: 'POST',
            url: 'getData.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&filterBy=' + filterBy + '&styleBy=' + styleBy + '&bathBy=' + bathBy + '&bedBy=' + bedBy + '&pmaxBy=' + pmaxBy + '&pminBy=' + pminBy + '&selectBy=' + selectBy + '&dateBy=' + dateBy + '&nearBy=' + nearBy,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#result').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }
</script>

<section class="topsection d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-house-door-fill"></i>
    <span class="display-5 mb-4">Listed properties</span>
    <form action="#" method="POST" role="search" id="form">
        <input class="searchbar" type="search" id="keywords" name="keywords" placeholder="Search..." aria-label="Search through site content" onkeyup="searchFilter();">
        <?php
        $_SESSION['agentselected'] = "";
        ?>
    </form>
</section>

<div class="grid-container">
    <div class="filter">
        <b><label style="font-size: 20px;"><i class='bx bx-filter-alt'></i>&nbsp;&nbsp;Search Filter</label></b><br><br>
        <button class="btnApply" style="height: 40px;" name="clear" id="clear" onclick="searchFilter();">Clear Filter</button>
        <hr>
        <label for="inputEmail4" class="form-label">House Style</label>
        <select class="form-select" style="width:170px;" name="style" id="style" onchange="searchFilter();">
            <option value="" selected disabled>Select Style</option>
            <option value="Modern">Modern</option>
            <option value="Contemporary">Contemporary</option>
            <option value="Cottage">Cottage</option>
            <option value="Bungalow">Bungalow</option>
            <option value="Rowhouse">Rowhouse</option>
            <option value="Townhouse">Townhouse</option>
            <option value="Duplex">Duplex</option>
        </select>
        <hr>
        <label for="inputEmail4" class="form-label">Location</label>
        <select class="form-select" style="width:170px;" name="city" id="city" onchange="searchFilter();">
            <option value="" selected disabled>Select City</option>
            <option value="Abucay">Abucay</option>
            <option value="Bagac">Bagac</option>
            <option value="Balanga">Balanga</option>
            <option value="Dinalupihan">Dinalupihan</option>
            <option value="Hermosa">Hermosa</option>
            <option value="Limay">Limay</option>
            <option value="Mariveles">Mariveles</option>
            <option value="Morong">Morong</option>
            <option value="Orani">Orani</option>
            <option value="Orion">Orion</option>
            <option value="Pilar">Pilar</option>
            <option value="Samal">Samal</option>
        </select>
        <hr>
        <label for="inputEmail4" class="form-label">Price</label>
        <input type="number" class="form-control" style="width:140px; height:20px;" name="pmax" id="pmax" placeholder="Maximum" onkeyup="searchFilter();">
        <div style="text-align:center;"><i class='bx bx-move-vertical'></i></div>
        <input type="number" class="form-control" style="width:140px; height:20px;" name="pmin" id="pmin" placeholder="Minimum" onkeyup="searchFilter();">
        <hr>
        <label for="inputEmail4" class="form-label">Bathroom</label>
        <select class="form-select" style="width:170px;" name="bathBy" id="bathBy" onchange="searchFilter();">
            <option value="" selected disabled>Select #</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
        <hr>
        <label for="inputEmail4" class="form-label">Bedroom</label>
        <select class="form-select" style="width:170px;" name="bedBy" id="bedBy" onchange="searchFilter();">
            <option value="" selected disabled>Select #</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
    </div>
    <div class="b">
        <div class="row">
            <p><label for="inputEmail4" class="form-label" style="font-size: 25px;"><b>Sort By</b></label></b>&nbsp;&nbsp;
                <select class="form-select" style="width:170px; height: 40px;" name="nearby" id="nearby" onchange="searchFilter();">
                    <option value="" selected disabled>Sort</option>
                    <option value="All">All</option>
                    <option value="<?php echo $row1['city']; ?>">Nearby</option>
                </select>
                <select class="form-select" style="width:170px; height: 40px;" name="pdate" id="pdate" onchange="searchFilter();">
                    <option value="" selected disabled>Date</option>
                    <option value="1">Oldest</option>
                    <option value="2">Latest</option>
                </select>
                <select class="form-select" style="width:170px; height: 40px;" name="pselect" id="pselect" onchange="searchFilter();">
                    <option value="" selected disabled>Price</option>
                    <option value="2">High to Low</option>
                    <option value="1">Low to High</option>
                </select>
            </p>
        </div>
        <div id="result" class="row">
            <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                <div class="card1">
                    <?php
                    if ($query->num_rows > 0) {
                        $i = 0;
                        while ($row = $query->fetch_assoc()) {
                            $i++;
                            $var1 = $row['property_ID'];
                            $picShow = "SELECT * FROM tbl_show WHERE property_ID = '$var1'";
                            $resShow = mysqli_query($connect, $picShow);
                            $a = array();
                            $x = 0;
                            $pic = mysqli_fetch_assoc($resShow)
                    ?>
                            <div class="card-body shadow">
                                <div>
                                    <?php
                                    if (isset($pic['propertyImg'])) {
                                        echo '<img  src="data:image/jpeg;base64,' . base64_encode($pic['propertyImg']) . '" width="450" height="200" class="d-block w-100" alt="First slide">';
                                    } else {
                                    ?>
                                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="360" height="200">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <form method="POST" action="properties.php" class="property-name-post d-flex form-control text-start">
                                    <input type="hidden" id="hide" name="hide" value="<?php echo $row['agent_ID'] ?>">
                                    <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide">
                                        <h5 class="card-title"><b><?php echo $row['title']; ?></b></h5>
                                    </button>
                                </form>
                                <ul class="list-group list-group-flush" style="line-height: 0; font-size: 14px;">
                                    <span class="icon-livingsize"></span>
                                    <hr>
                                    <li class="list-group-item">
                                        <span><b>Bedroom:</b>&nbsp;<?php echo $row['bedroom']; ?></span>&nbsp;&nbsp;&nbsp;
                                        <span><b>Bathroom:</b>&nbsp;<?php echo $row['bathroom']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span><b>Land Size:</b>&nbsp;<?php echo $row['lotSize']; ?>m²</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span><b>Garage:&nbsp;</b><span class="text-success"><?php echo $row['garage']; ?></span>&nbsp;&nbsp;&nbsp;
                                            <span><b>Basement:</b>&nbsp;<?php echo $row['basement']; ?></span>&nbsp;&nbsp;&nbsp;
                                            <span><b>Floor Area:</b>&nbsp;<?php echo $row['floorArea']; ?>m²</span>
                                    </li>
                                    <hr>
                                    <li class="list-group-item">
                                        <b>Style:&nbsp;</b><?php echo $row['propertyType']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>Special Features:&nbsp;</b><?php echo $row['specialFeatures']; ?>
                                    </li>
                                    <hr>
                                    <li class="list-group-item text-muted">
                                        <p class="card-text"><small class="text-muted" style="line-height: 0; font-size: 15px;"><?php echo $row['location'] ?></small></p>
                                    </li>
                                    <hr>
                                </ul>
                                <?php
                                if (!isset($_SESSION['verified_user_id'])) { ?>
                                    <div class="card-footer text-muted">
                                        <small class="text-muted" style="line-height: 0; font-size: 20px;"><b>&nbsp;&nbsp;&nbsp;₱&nbsp;<?php echo $row['price'] ?></b></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button class="buybtn btn btn-dark" onclick="window.location.href='login.php';">Buy</button>
                                    </div>
                                    <br>
                                <?php } else {
                                    $var = $_SESSION['user_ID']; ?>
                                    <form method="POST" onsubmit="return confirm('<?php echo 'Are you sure you want to buy ' . $row['title']; ?>');" action="propertiescode.php" class="property-name-post d-flex form-control text-start">
                                        <input type="hidden" id="user" name="user" value="<?php echo $var ?>">
                                        <input type="hidden" id="agent" name="agent" value="<?php echo $row['agent_ID'] ?>">
                                        <input type="hidden" id="property" name="property" value="<?php echo $row['property_ID'] ?>">
                                        <hr>
                                        <div>
                                            <?php
                                            if ($_SESSION['enduser'] == 'User') { ?>
                                                <div class="card-footer text-muted">
                                                    <small class="text-muted" style="line-height: 0; font-size: 20px;"><b>&nbsp;&nbsp;&nbsp;₱&nbsp;<?php echo $row['price'] ?></b></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <button type="submit" id="btn_hide1" name="btn_hide1" class="buybtn btn btn-light">Buy</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="6">No records found...</td></tr>';
                    }
                    ?>
                </div>
                <div class="row">
                    <?php echo $pagination->createLinks(); ?>
                </div>
            </div>
        </div>
    </div>
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