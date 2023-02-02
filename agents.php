<?php
include_once 'header.php';

include('dbconfig.php');
$_SESSION['agentselected'] = "";
?>

<style>
    <?php include 'css/agents.css'; ?>
    
</style>

<script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("content-table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }
</script>

<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1 class="display-5">Find your agent on this page</h1>
</section>

<form action="agents.php" method="POST" role="search" id="form">
    <input type="text" id="myInput" name="myInput" placeholder="Search..." title="Type in a name" aria-label="Search through site content">
    <select class="form-select" name="filter" id="filter" required>
        <option value="Name">Name</option>
        <option value="Agency">Agency</option>
        <option value="Location">Location</option>
    </select>
    <span class="vr me-3"></span>
    <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg></button>
</form>

<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4 class="fw-normal">Bataan Agents</h4>
        <?php
        $sqlAll = "SELECT * FROM tbl_agent";
        $resAll= mysqli_query($connect, $sqlAll);
        if (isset($_POST['btn_search'])) {
            $new = $_POST['myInput'];
            $filter = $_POST['filter'];
            if (!$new) { ?>
                <script>
                    alert('SearchBar is Empty');
                    exit;
                </script>
            <?php }

            if ($filter == 'Location') {
                $sqlAll = "SELECT * from tbl_agent WHERE city LIKE '%$new%' OR brgy LIKE '%$new%' OR str LIKE '%$new%'";
                $resAll = mysqli_query($connect, $sqlAll);
            }elseif($filter == 'Name') {
                $sqlAll = "SELECT * from tbl_agent WHERE fName LIKE '%$new%' OR lName LIKE '%$new%'";
                $resAll = mysqli_query($connect, $sqlAll);
            }elseif($filter == 'Agency') {
                $sqlAll = "SELECT * from tbl_agent WHERE agency LIKE '%$new%'";
                $resAll = mysqli_query($connect, $sqlAll);
            }else {
            ?>
                <script>
                    alert('SearchBar is Empty');
                    exit;
                </script>
            <?php
            }
        }
        ?>
        <p><b><?php echo mysqli_num_rows($resAll)?></b> Results</p>
    </div>
    <div class="agentslist-panel">

        <?php
        while ($row = mysqli_fetch_array($resAll)) {
            // if ($row['Status'] == "Pending") {
            //     continue;
            // }
        ?>
            <!-- CARD FOR EACH AGENT PAR-->
            <div class="agentcard row g-0 mt-2 shadow">
                <div class="col-md-2">
                    <?php 
                        if (!$row['displayImg']) {
                            ?>
                                <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150"/>
                            <?php
                            } else {
                            ?>
                                <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($row['displayImg']).'" class="img-fluid rounded-start" alt="..." width="150" height="150">'; ?>
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

            </div>
        <?php
        }
        ?>
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