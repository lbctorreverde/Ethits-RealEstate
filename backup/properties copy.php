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
    <form action="properties.php" method="POST" role="search" id="form">
        <input type="search" id="searchProp" name="searchProp" placeholder="Search..." aria-label="Search through site content">
        <?php
        $_SESSION['agentselected'] = "";
        ?>
        <select class="form-select" name="filter" id="filter" required>
            <option value="Title">Title</option>
            <option value="Bath">Bathroom</option>
            <option value="Bed">Bedroom</option>
            <option value="Sf">Special Features</option>
            <option value="ptype">Property Type</option>
            <option value="Loc">Location</option>
        </select>
        <span class="vr me-3"></span>
        <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg></button>
    </form>
</section>

<div class="grid-container">
    <div>1</div>
    <div class="b">
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
            
                        if ($filter == 'Location') {
                            $query  = "SELECT * from tbl_property WHERE location LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }elseif($filter == 'Bath') {
                            $query  = "SELECT * from tbl_property WHERE bathroom LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }elseif($filter == 'Bed') {
                            $query  = "SELECT * from tbl_property WHERE bedroom LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }elseif($filter == 'Title') {
                            $query  = "SELECT * from tbl_property WHERE title LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }elseif($filter == 'Sf') {
                            $query  = "SELECT * from tbl_property WHERE specialFeatures LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }elseif($filter == 'ptype') {
                            $query  = "SELECT * from tbl_property WHERE propertyType LIKE '%$new%'";
                            $result = mysqli_query($connect, $query);
                        }
                    }
                    $classadd = 0;
                    while ($rowShow = mysqli_fetch_array($result)) {
                    $classadd++;
                    ?>
                <div class="col">
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
<script>

function $(selector)
{
  return document.querySelector(selector);
}

load_product(1, '');

function load_product(page = 1, query = '')
{
    $('#product_area').style.display = 'none';

    $('#skeleton_area').style.display = 'block';

    $('#skeleton_area').innerHTML = make_skeleton();

    fetch('process.php?page='+page+query+'').then(function(response){

        return response.json();

    }).then(function(responseData){

        var t_html = '';
        if(responseData.data)
        {
            if(responseData.data.length > 0)
            {
                t_html += '<p class="h6">'+responseData.total_data+' Products Found</p>';
                t_html += '<div class="grid-container">';
                for(var i = 0; i < responseData.data.length; i++)
                {
                    t_html += '<div class="col-md-3 mb-2 p-3">';
                    t_html += '<img src = "'+responseData.data[i].image+'" class="img-fluid border mb-3 p-3" />';
                    t_html += '<p class="fs-6 text-center">'+responseData.data[i].name+'&nbsp;&nbsp;&nbsp;<span class="badge bg-info text-dark">'+responseData.data[i].brand+'</span><br />';
                    t_html += '<span class="fw-bold text-danger"><span>&#8377;</span> '+responseData.data[i].price+'</p>';
                    t_html += '</div>';
                }
                t_html += '</div>';
                $('#product_area').innerHTML = t_html;
            }
            else
            {
                $('#product_area').innerHTML = '<p class="h6">No Product Found</p>';
            }
        }

        if(responseData.pagination)
        {
            $('#pagination_area').innerHTML = responseData.pagination;
        }

        setTimeout(function(){

            $('#product_area').style.display = 'block';

            $('#skeleton_area').style.display = 'none';

        }, 3000);

    });
}

function make_skeleton()
{
    var output = '<div class="grid-container">';
    for(var count = 0; count < 8; count++)
    {
        output += '<div class="col-md-3 mb-3 p-4">';
        output += '<div class="mb-2 bg-light text-dark" style="height:240px;"></div>';
        output += '<div class="mb-2 bg-light text-dark" style="height:50px;"></div>';
        output += '<div class="mb-2 bg-light text-dark" style="height:25px;"></div>';
        output += '</div>';
    }
    output += '</div>';
    return output;
}

load_filter();

function load_filter()
{
    fetch('process.php?action=filter').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.gender)
        {
            if(responseData.gender.length > 0)
            {
                var html = '<div class="list-group">';
                for(var i = 0; i < responseData.gender.length; i++)
                {
                    html += '<label class="list-group-item">';

                    html += '<input class="form-check-input me-1 gender_filter" type="radio" name="gender_filter" value="'+responseData.gender[i].name+'">';

                    html += responseData.gender[i].name+' <span class="text-muted">('+responseData.gender[i].total+')</span>';

                    html += '</label>';
                }

                html += '</div>';

                $('#gender_filter').innerHTML = html;

                var gender_elements = document.getElementsByClassName("gender_filter");

                for(var i = 0; i < gender_elements.length; i++)
                {
                    gender_elements[i].onclick = function(){

                        load_product(page = 1, make_query());

                    };
                }
            }
        }

        if(responseData.brand)
        {
            if(responseData.brand.length > 0)
            {
                var html = '<div class="list-group">';
                for(var i = 0; i < responseData.brand.length; i++)
                {
                    html += '<label class="list-group-item">';

                    html += '<input class="form-check-input me-1 brand_filter" type="checkbox" value="'+responseData.brand[i].name+'">';

                    html += responseData.brand[i].name+' <span class="text-muted">('+responseData.brand[i].total+')</span>';

                    html += '</label>';
                }

                html += '</div>';

                $('#brand_filter').innerHTML = html;

                var brand_elements = document.getElementsByClassName("brand_filter");

                for(var i = 0; i < brand_elements.length; i++)
                {
                    brand_elements[i].onclick = function(){

                        load_product(page = 1, make_query());

                    };
                }
            }
        }

        if(responseData.price)
        {
            if(responseData.price.length > 0)
            {
                var html = '<div class="list-group">';

                for(var i = 0; i < responseData.price.length; i++)
                {
                    html += '<a href="#" class="list-group-item list-group-item-action price_filter" id="'+responseData.price[i].condition+'"><span>&#8377;</span> '+responseData.price[i].name+' <span class="text-muted">('+responseData.price[i].total+')</a>';
                }

                html += '</div>';

                $('#price_filter').innerHTML = html;

                var price_elements = document.getElementsByClassName("price_filter");

                for(var i = 0; i < price_elements.length; i++)
                {
                    price_elements[i].onclick = function(){

                        remove_active_class(price_elements);

                        this.classList.add("active");

                        load_product(page = 1, make_query());

                    };
                }

            }
        }

    });
}

function remove_active_class(element)
{
    for(var i = 0; i < element.length; i++)
    {
        if(element[i].matches('.active'))
        {
            element[i].classList.remove("active");
        }
    }
}

function make_query()
{
    var query = '';

    var gender_elements = document.getElementsByClassName("gender_filter");

    for(var i = 0; i < gender_elements.length; i++)
    {
        if(gender_elements[i].checked)
        {
            query += '&gender_filter='+gender_elements[i].value+'';
        }
    }

    var price_elements = document.getElementsByClassName("price_filter");

    for(var i = 0; i < price_elements.length; i++)
    {
        if(price_elements[i].matches('.active'))
        {
            query += '&price_filter='+price_elements[i].getAttribute("id")+'';
        }
    }

    var brand_elements = document.getElementsByClassName("brand_filter");

    var brandlist = '';

    for(var i = 0; i < brand_elements.length; i++)
    {
        if(brand_elements[i].checked)
        {
            brandlist += brand_elements[i].value + ',';
        }
    }

    if(brandlist != '')
    {
        query += '&brand_filter='+brandlist+'';
    }

    return query;
}

$('#clear_filter').onclick = function(){

    var gender_elements = document.getElementsByClassName("gender_filter");

    for(var i = 0; i < gender_elements.length; i++)
    {
        gender_elements[i].checked = false;
    }

    var price_elements = document.getElementsByClassName("price_filter");

    remove_active_class(price_elements);

    var brand_elements = document.getElementsByClassName("brand_filter");

    for(var i = 0; i < brand_elements.length; i++)
    {
        brand_elements[i].checked = false;
    }

    load_product(1, '');

};

</script>