
<?php

if(isset($_POST['page'])){ 
    // Include pagination library file 
    include_once 'Pagination.class.php'; 
     
    // Include database configuration file 
    require_once 'dbconfig.php';
    $filter = $_POST['filterBy'];
    $style = $_POST['styleBy'];
    $bath = $_POST['bathBy'];
    $bed = $_POST['bedBy'];
    $max = $_POST['pmaxBy'];
    $min = $_POST['pminBy'];
    $pselect = $_POST['selectBy'];
    $pdate = $_POST['dateBy'];
    $nearBy = $_POST['nearBy'];
    // Set some useful configuration 
    $baseURL = 'getData.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 6; 
     
    //Set conditions for search 
    $whereSQL = ''; 
    if(!empty($_POST['keywords'])){ 
        $whereSQL = " WHERE (title LIKE '%".$_POST['keywords']."%' OR location LIKE '%".$_POST['keywords']."%' OR propertyType LIKE '%".$_POST['keywords']."%')"; 
    }

    if(!empty($max) && $min == ''){ 
        $whereSQL = " WHERE price<=".$max." and price>= '0'"; 
    }elseif($max== '' && !empty($min)){
        $whereSQL = " WHERE price<= '0' and price>=".$min; 
    }elseif(!empty($max) && !empty($min)){ 
        $whereSQL = " WHERE price<=".$max." and price>=".$min; 
    }

    if(strval($pselect) == 'null'){
        $pselect = '';
    }

    if(strval($filter) == 'null'){
        $filter = '';
    }
    
    if(strval($style) == 'null'){
        $style = '';
    }

    if (strval($bath) == 'null') {
        $bath = '';
    }

    if(strval($bed) == 'null'){
        $bed = '';
    }

    if(strval($nearBy) == 'null'){
        $nearBy= '';
    }

    if($filter != ''){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " location LIKE '%".$filter."%'"; 
    }elseif ($nearBy == 'All') {
        $whereSQL .= ""; 
    }elseif ($nearBy != '') {
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " location LIKE '%".$nearBy."%'"; 
    }

    if($style != ''){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " propertyType LIKE '%".$style."%'"; 
    }

    if($bath != '' && $bath != '+4'){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " bathroom = ".$bath; 
    }

    if($bath != '' && $bath == '+4'){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " bathroom NOT IN (1,2,3) AND bathroom= ".$bath; 
    }

    if($bed != '' && $bed != '+4'){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " bedroom = ".$bed; 
    }

    if($bed != '' && $bed == '+4'){ 
        $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
        $whereSQL .= " bedroom NOT IN (1,2,3) AND bedroom = ".$bed; 
    }
    
    if($pselect == 2){ 
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " price DESC"; 
    }elseif($pselect == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " price ASC"; 
    }elseif($pdate == 2){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " propertyDate ASC"; 
    }elseif($pdate == 1){
        $whereSQL .= (strpos($whereSQL, 'ORDER BY') !== false)?" ":" ORDER BY "; 
        $whereSQL .= " propertyDate DESC"; 
    }

    // if($_POST['filterBy'] != null){ 
    //     $whereSQL .= (strpos($whereSQL, 'WHERE') !== false)?" AND ":" WHERE "; 
    //     $whereSQL .= " location LIKE '%".$_POST['filterBy']."%'"; 
    // }
    // Count of all records 
    $query   = $connect->query("SELECT COUNT(*) as rowNum FROM tbl_property ".$whereSQL); 
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
    $query = $connect->query("SELECT * FROM tbl_property $whereSQL LIMIT $offset,$limit");
?> 
    <!-- Data list container --> 
    <div  class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                <div class="card1">
                    <?php
                        if($query->num_rows > 0){ $i=0; 
                            while($row = $query->fetch_assoc()){ $i++;
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
                                if(isset($pic['propertyImg'])){
                                    echo '<img  src="data:image/jpeg;base64,'.base64_encode($pic['propertyImg']).'" width="450" height="200" class="d-block w-100" alt="First slide">';
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
                                <span ><b>Garage:&nbsp;</b><span class="text-success"><?php echo $row['garage']; ?></span>&nbsp;&nbsp;&nbsp;
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
                                <p class="card-text"><small class="text-muted" style="line-height: 0; font-size: 15px;"><?php echo $row['location']?></small></p>
                            </li>
                            <hr>
                        </ul>
                        <?php
                        if (isset($_SESSION['user_ID'])) {
                            $var = $_SESSION['user_ID'];
                        }
                        ?>
                        <?php
                            if (!isset($_SESSION['user_ID'])) {?>
                                <div class="card-footer text-muted" >
                                    <small class="text-muted" style="line-height: 0; font-size: 20px;"><b>&nbsp;&nbsp;&nbsp;₱&nbsp;<?php echo $row['price']?></b></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button onclick="window.location.href='login.php';" >Buy</button>
                                </div>
                                <br>
                            <?php }else{
                                $var = $_SESSION['user_ID'];?>
                        <form method="POST" onsubmit="return confirm('<?php echo 'Are you sure you want to buy '.$row['title'];?>');" action="propertiescode.php" class="property-name-post d-flex form-control text-start">
                            <input type="hidden" id="user" name="user" value="<?php echo $var?>">
                            <input type="hidden" id="agent" name="agent" value="<?php echo $row['agent_ID'] ?>">
                            <input type="hidden" id="property" name="property" value="<?php echo $row['property_ID'] ?>">
                            <hr>
                            <div>
                                <?php
                                    if ($_SESSION['enduser'] == 'User') {?>
                                        <button type="submit" id="btn_hide1" name="btn_hide1" class="btn btn-light" >Buy</button>
                                <?php }?>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                <?php 
                        } 
                    }else{ 
                        echo '<tr><td colspan="6">No records found...</td></tr>'; 
                    } 
                ?>
                </div>
                <div class="row">
                    <?php echo $pagination->createLinks(); ?>
                </div>
            </div>
<?php 
} 
?>