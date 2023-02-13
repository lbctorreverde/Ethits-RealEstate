
<?php

if(isset($_POST['page'])){ 
    // Include pagination library file 
    include_once 'Pagination.class.php'; 
     
    // Include database configuration file 
    require_once 'dbconfig.php';
    $filter = $_POST['filterBy'];
    $prating = $_POST['selectBy'];
    $pdate = $_POST['dateBy'];
    $nearBy = $_POST['nearBy'];
    // Set some useful configuration 
    $baseURL = 'agentsearch.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 6; 
     
    //Set conditions for search 
    $whereSQL = ''; 
    if(!empty($_POST['keywords'])){ 
        $whereSQL = " WHERE (fName LIKE '%".$_POST['keywords']."%' OR lName LIKE '%".$_POST['keywords']."%' OR city LIKE '%".$_POST['keywords']."%' OR brgy LIKE '%".$_POST['keywords']."%' OR str LIKE '%".$_POST['keywords']."%')"; 
    }

    if(strval($prating) == 'null'){
        $prating = '';
    }

    if(strval($pdate) == 'null'){
        $pdate = '';
    }

    if(strval($filter) == 'null'){
        $filter = '';
    }

    if(strval($nearBy) == 'null'){
        $nearBy= '';
    }

    if($filter != ''){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " city LIKE '%".$filter."%'"; 
    }

    if($filter != ''){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " city LIKE '%".$filter."%'"; 
    }elseif ($nearBy == 'All') {
        $whereSQL .= ""; 
    }elseif ($nearBy != '') {
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " city LIKE '%".$nearBy."%'"; 
    }

    if($prating == 5){ 
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " rating DESC"; 
    }elseif($prating == 4){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " rating ASC"; 
    }elseif($prating == 3){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " rating ASC"; 
    }elseif($prating == 2){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " rating DESC"; 
    }elseif($prating == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " rating ASC"; 
    }elseif($pdate == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " email_verified_at DESC"; 
    }elseif($pdate == 2){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " email_verified_at ASC"; 
    }elseif($pdate == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " propertyDate DESC"; 
    }elseif($pdate == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " propertyDate DESC"; 
    }elseif($pdate == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " propertyDate DESC"; 
    }

    // if($_POST['filterBy'] != null){ 
    //     $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
    //     $whereSQL .= " location LIKE '%".$_POST['filterBy']."%'"; 
    // }
    // Count of all records
    $query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_agent ".$whereSQL); 
    $result  = $query->fetch_assoc(); 
    $rowCount= $result['rowNum']; 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'result', 
        'link_func' => 'searchFilter' 
    ); 
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit 
    $query = $connect->query("SELECT * FROM tbl_agent $whereSQL LIMIT $offset,$limit");
?> 
    <!-- Data list container --> 
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
<?php 
} 
?>