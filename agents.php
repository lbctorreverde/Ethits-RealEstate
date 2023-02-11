<?php
include_once 'header.php';

include('dbconfig.php');
$_SESSION['agentselected'] = "";
// Include pagination library file 
include_once 'Pagination.class.php'; 
 
// Set some useful configuration 
$baseURL = 'agentsearch.php'; 
$limit = 6; 
 
// Count of all records 
$query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_agent"); 
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

$query = $connect->query("SELECT * FROM tbl_agent LIMIT $limit"); 
?>

<style>
    <?php include 'css/agents.css'; ?>
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
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var filterBy = $('#city').val();
        var selectBy = $('#prating').val();
        var dateBy = $('#pdate').val();
        var nearBy = $('#nearby').val();

        $('#city').click(function(){  
            $('#prating').prop('selectedIndex', 0)
            $('#pdate').prop('selectedIndex', 0)
            $('#prating').prop('selectedIndex', 0)
        });

        $('#nearby').click(function(){  
            $('#prating').prop('selectedIndex', 0)
            $('#pdate').prop('selectedIndex', 0)
            $('#city').prop('selectedIndex', 0)
        });

        $('#pdate').click(function(){  
            $('#prating').prop('selectedIndex', 0)
            $('#nearby').prop('selectedIndex', 0)
            $('#city').prop('selectedIndex', 0)
        });

        $('#prating').click(function(){  
            $('#pdate').prop('selectedIndex', 0)
            $('#nearby').prop('selectedIndex', 0)
            $('#city').prop('selectedIndex', 0)
        });

        $.ajax({
            type: 'POST',
            url: 'agentsearch.php',
            data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy+'&selectBy='+selectBy+'&dateBy='+dateBy+'&nearBy='+nearBy,
            beforeSend: function () {
                $('.loading-overlay').show();
            },
            success: function (html) {
                $('#result').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }
</script>

<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1 class="display-5">Find your agent on this page</h1>
</section>

<form action="agents.php" method="POST" role="search" id="form">
<input type="search" id="keywords" name="keywords" placeholder="Search..." aria-label="Search through site content" onkeyup="searchFilter();">
    
</form>

<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4 class="fw-normal">Bataan Agents</h4>
        
        <p><b><?php echo mysqli_num_rows($query) ?></b>&nbsp;&nbsp;Results</p>
    </div>
    <div class="agentslist-panel">
        <div class='row'>
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
            <select class="form-select" style="width:170px; height: 40px;" name="prating" id="prating" onchange="searchFilter();">
                <option value="" selected disabled>Rating</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
            <select class="form-select" style="width:170px;  height: 40px;" name="city" id="city" onchange="searchFilter();">
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
        </div>
            <!-- CARD FOR EACH AGENT PAR-->
        <div id='result'>
            <div>
                <div class="agentcard row g-0 mt-2 shadow">
                    <?php
                        if($query->num_rows > 0){ $i=0;
                        while ($row = $query->fetch_assoc()) {
                    ?>
                    <div class="col-md-2">
                        <?php
                        if (!$row['displayImg']) {
                            ?>
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150"/>
                                <?php
                        } else {
                            ?>
                                    <?php echo '<img  src="data:image/jpeg;base64,' . base64_encode($row['displayImg']) . '" class="img-fluid rounded-start" alt="..." width="150" height="150">'; ?>
                                <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <!-- Paiba nalang, sa notfound.php pa redirect nya eh -->
                            <form method="POST" action="agents.php" class="agent-name-post d-flex form-control text-start">
                                <input type="hidden" id="hide" name="hide" value="<?php echo $row['agent_ID'] ?>">
                                <button class="agent-name-button" type="submit" id="btn_hide" name="btn_hide">
                                    <?php echo $row['lName'] . ", " . $row['fName'] . " " . substr($row['mName'], 0, 1) . "." ?>
                                </button>
                            </form>
                            <!-- <input type="hidden" id="hide" name="hide" value="<?php //echo $row['agemt_ID'] ?>">
                            <a onclick="window.location.href='agentC.php'" type="submit" id="btn_hide" name="btn_hide"><?php //echo $row['lName'] . ", " . $row['fName'] . " " . substr($row['mName'], 0, 1) . "." ?></a> -->
                            <br>
                            <p class="card-text text-muted">Real Estate Professional<br>
                                <?php echo $row['agency'] . " - " . $row['str'] . ", " . $row['brgy'] . ", " . $row['city'] . ", Bataan" ?>
                            </p>
                            <p class="card-title text-muted">Contact: </p>
                            <p class="card-text"><small class="text-muted lh-sm"><?php echo $row['contactNo'] ?></small></p>
                        </div>
                    </div>
                    <?php 
                        }
                    }else{ 
                        echo '<tr><td colspan="6">No records found...</td></tr>'; 
                    } 
                    ?>
                </div>
            </div>
            <br>
            <div class="row">
                <?php echo $pagination->createLinks(); ?>
            </div>
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