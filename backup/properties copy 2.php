<?php
include_once 'header.php';
include('dbconfig.php');
?>

<style>
    <?php include 'css/properties.css' ?>
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var filterBy = $('#filterBy').val();
        $.ajax({
            type: 'POST',
            url: 'getData.php',
            data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy,
            beforeSend: function () {
                $('.loading-overlay').show();
            },
            success: function (html) {
                $('#dataContainer').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }

    // $(document).on('change', '#bath', function() {
    //     $('.card').removeClass('d-none');
    //     var filter = $(this).val(); // get the value of the input, which we filter on
    //     $('.col').find('.card h4:not(:contains("'+filter+'"))').parent().parent().addClass('d-none');
    // })

    
    // $(document).on('change', '#bath', function() {
    //     var value = $(this).val().toLowerCase();
    //     jQuery("#result *").filter(function() {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //     });
    // });
    // var size = 4;
    // var $cont,chunks;
    // var html = '';
    // jQuery(document).ready(function($) {

    // $cont = $('.properties-list container-fluid d-flex flex-column justify-content-center align-items-center');
    // var filterChecks = $('.grid-container: filter');
    // createPagination($cont);
    // filterChecks.change(function() {
    //     html = '';
    //     var results = [];
    //     var classSelectors = filterChecks.filter(':selected').map(function() {
    //         return '.' + this.value;
    //     }).get();
    
    //     if(classSelectors.length){
    //     for(var x = 0; x < $cont.has(classSelectors.join()).length; x++){
    //         results.push($cont.has(classSelectors.join())[x]);
    //     }
    //     createPagination(results);
    //     } else {
    //     createPagination($cont);
    //     }
    // });

    // $('div.pagination').on('click', 'a', function(){
    //     $cont.hide();
    //     $(chunks[parseInt($(this).text())-1]).show();
    // });

    // });

    // function createPagination(data){
    // chunks = new Array(Math.ceil(data.length / size)).fill("").map(function() {
    //     return this.splice(0, size)
    // }, data.slice());
    
    // $cont.hide();
    
    // for(var i = 0; i < chunks.length; i++){
    //     html += '<li><a href="#">'+(i+1)+'</li>';
    // }

    // $('div.pagination').html(html);
    // $(chunks[0]).show();
    // }
</script>


<section class="topsection d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-house-door-fill"></i>
    <span class="display-5 mb-4">Listed properties</span>
    <form action="properties.php" method="POST" role="search" id="form">
        <input type="search" id="searchProp" name="searchProp" placeholder="Search..." aria-label="Search through site content">
        <?php
        $_SESSION['agentselected'] = "";
        ?>
        <span class="vr me-3"></span>
        <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg></button>
    </form>
</section>

<div class="grid-container">
    <div class="filter">
        <b><label style="font-size: 20px;"><i class='bx bx-filter-alt'></i>&nbsp;&nbsp;Search Filter</label></b><br><br>
        <button class="btnApply" style="height: 40px;">Clear Filter</button>
        <hr>
        <label for="inputEmail4" class="form-label">House Style</label>
        <select class="form-select" style="width:170px;" name="style" id="style" required>
            <option value="" selected disabled>Select Style</option>
            <option value="Abucay">Modern</option>
            <option value="Bagac">Contemporary</option>
            <option value="Balanga">Cottage</option>
            <option value="Dinalupihan">Bungalow</option>
            <option value="Hermosa">Rowhouse</option>
            <option value="Limay">Townhouse</option>
            <option value="Mariveles">Duplex</option>
        </select>
        <hr>
        <label for="inputEmail4" class="form-label">Location</label>
        <select class="form-select" style="width:170px;" name="city" id="city" required>
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
        <input type="number" class="form-control" style="width:140px; height:20px;"  name="bath" id="bath" placeholder="Maximum" required>
        <div style="text-align:center;"><i class='bx bx-move-vertical'></i></div>
        <input type="number" class="form-control" style="width:140px; height:20px;" name="bath" id="bath" placeholder="Minimum" required>
        <br><button class="btnApply">Apply</button>
        <hr>
        <label for="inputEmail4" class="form-label">Bathroom</label>
        <select class="form-select" style="width:170px;" name="bath" id="bath" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
        <hr>
        <label for="inputEmail4" class="form-label">Bedroom</label>
        <select class="form-select" style="width:170px;" name="bed" id="bed" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
    </div>
    <div class="b">
        <div class="row">
            <p><label for="inputEmail4" class="form-label" style="font-size: 25px;"><b>Sort By</b></label></b>&nbsp;&nbsp;
            <button class="btnApply" style="height: 40px;">Nearby</button>&nbsp;&nbsp;
            <button class="btnApply" style="height: 40px;">Latest</button>&nbsp;&nbsp;
            <select class="form-select" style="width:170px; height: 40px;" name="bed" id="bed" required>
                <option value="" selected disabled>Price</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </p>
        </select>
        </div>
        <div class="row">
            <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php
                        $query = "SELECT * FROM tbl_property";
                        $result = mysqli_query($connect, $query);
                        if (isset($_POST['btn_search'])) {
                            $new = $_POST['searchProp'];
                            $filter = $_POST['filter'];

                            if (!$new) { ?>
                                <script>
                                    alert('SearchBar is Empty');
                                    exit;
                                </script>
                            <?php }
                
                            // if ($filter == 'Location') {
                            //     $query  = "SELECT * from tbl_property WHERE location LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }elseif($filter == 'Bath') {
                            //     $query  = "SELECT * from tbl_property WHERE bathroom LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }elseif($filter == 'Bed') {
                            //     $query  = "SELECT * from tbl_property WHERE bedroom LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }elseif($filter == 'Title') {
                            //     $query  = "SELECT * from tbl_property WHERE title LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }elseif($filter == 'Sf') {
                            //     $query  = "SELECT * from tbl_property WHERE specialFeatures LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }elseif($filter == 'ptype') {
                            //     $query  = "SELECT * from tbl_property WHERE propertyType LIKE '%$new%'";
                            //     $result = mysqli_query($connect, $query);
                            // }
                        }
                        $classadd = 0;
                        while ($rowShow = mysqli_fetch_array($result)) {
                        $classadd++;
                        ?>
                    <div id="result" class="col">
                        <div class="card ">
                                    <?php
                                        $var1 = $rowShow['property_ID'];
                                        $picShow = "SELECT * FROM tbl_show WHERE property_ID = '$var1'";
                                        $resShow = mysqli_query($connect, $picShow);
                                        $a = array();
                                        $x = 0;
                                        while ($pic = mysqli_fetch_array($resShow)) {
                                            $x++;
                                            if ($x == 1) {
                                                $classname = 'carousel-item active';
                                            } else {
                                                $classname = 'carousel-item';
                                            }
                                    ?>
                                    <div class="<?php echo $classname;?>">
                                        <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($pic['propertyImg']).'" width="450" height="200" class="d-block w-100" alt="First slide">'; ?>
                                    </div>
                                    <?php }?>
                            <div class="card-body shadow">
                                <form method="POST" action="properties.php" class="property-name-post d-flex form-control text-start">
                                    <input type="hidden" id="hide" name="hide" value="<?php echo $rowShow['agent_ID'] ?>">
                                    <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide">
                                        <h5 class="card-title"><?php echo $rowShow['title']; ?></h5>
                                    </button>
                                </form>
                                <ul class="list-group list-group-flush">
                                    <span class="icon-livingsize"></span>
                                    <li class="list-group-item">
                                        <span><b>Land Size:</b>&nbsp;<?php echo $rowShow['lotSize']; ?>m²</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span ><b >Status:&nbsp;</b><span class="text-success"><?php echo $rowShow['statusProperty']; ?></span></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Bathroom:&nbsp;</b> <?php echo $rowShow['bathroom']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>Bedroom:&nbsp;</b> <?php echo $rowShow['bedroom']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Garage:&nbsp;</b> <?php echo $rowShow['garage']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>Basement:&nbsp;</b> <?php echo $rowShow['basement']; ?>
                                    </li>
                                    <li class="list-group-item"><b>Special Features:&nbsp;</b><?php echo $rowShow['specialFeatures']; ?></li>
                                    <li class="list-group-item text-muted">
                                        <p class="card-text"><small class="text-muted"><?php echo $rowShow['location']; ?></small></p>
                                    </li>
                                </ul>
                                <?php
                                if (isset($_SESSION['user_ID'])) {
                                    $var = $_SESSION['user_ID'];
                                }
                                ?>
                                <?php
                                    if (!isset($_SESSION['user_ID'])) {?>
                                        <div class="card-footer text-muted" style="text-align: center;">
                                            <button onclick="window.location.href='login.php';" >Buy</button>
                                        </div>
                                    <?php }else{
                                        $var = $_SESSION['user_ID'];?>
                                <form method="POST" onsubmit="return confirm('<?php echo 'Are you sure you want to buy '.$rowShow['title'];?>');" action="propertiescode.php" class="property-name-post d-flex form-control text-start">
                                    <input type="hidden" id="user" name="user" value="<?php echo $var?>">
                                    <input type="hidden" id="agent" name="agent" value="<?php echo $rowShow['agent_ID'] ?>">
                                    <input type="hidden" id="property" name="property" value="<?php echo $rowShow['property_ID'] ?>">
                                    <hr>
                                    <div style="text-align: center;">
                                        <button type="submit" id="btn_hide1" name="btn_hide1" class="btn btn-light" >Buy</button>
                                    </div>
                                </form>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="pagination">
                <li><a href="#">1</a></li>
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
