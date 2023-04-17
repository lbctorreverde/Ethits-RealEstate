<?php
include_once 'header.php';
include 'chome.php';
// if (isset($_GET['user'])) {
//     include 'chat.php';
// }else {
    
// }
?>

<style>
    <?php include 'css/index.css' ?>
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet"  href="css/nested.scss">
<script type="text/javascript">
    $(document).ready(function() {
    // Gets the span width of the filled-ratings span
    // this will be the same for each rating
    var star_rating_width = $('.fill-ratings span').width();
    // Sets the container of the ratings to span width
    // thus the percentages in mobile will never be wrong
    $('.star-ratings').width(star_rating_width);
    });

</script>
<main role="main">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <section class="intro-intro d-flex container-fluid text-start flex-column justify-content-center" id="intro-one">
                    <div class="hidden">
                        <h1>Find the Agent for your needs </h1>
                        <h3 class="lead">Looking for an agent? You've come to the right place!</h3>
                    </div>
                </section>
            </div>
            <div class="carousel-item">
                <section class="intro-intro d-flex container-fluid text-center flex-column justify-content-center" id="intro-two">
                    <div class="hidden">
                        <h1>"First of all, what does this thing do?"</h1>
                        <h3 class="lead">This "thing" aims to assist not just Real Estate agents, but also people looking for agents or properties regarding their Real Estate needs.</h3>
                    </div>
                </section>
            </div>
            <div class="carousel-item">
                <section class="intro-intro d-flex container-fluid text-end flex-column justify-content-center" id="intro-three">
                    <div class="hidden">
                        <h1>A roster of Real Estate Agents at your fingertips</h1>
                        <h3 class="lead">Or maybe you're an agent who wants to be heard and attract more clients.</h3>
                    </div>
                </section>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid topagents-div">
        <h1 class="header">Featured Agents</h1>
        <div class="carousel-inner agents-carousel">
            <div class="carousel-item active">
                <div class="row row-cols-3" >
                    <!-- loop -->
                    <?php
                        $query = $connect->query("SELECT * FROM tbl_agent ORDER BY prate DESC LIMIT 3");
                        while($res = $query->fetch_assoc()){
                    ?>
                    <div class="col">
                        <div class="card agent-card">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <?php 
                                    if(isset($res['displayImg'])){
                                        echo '<img  src="data:image/jpeg;base64,'.base64_encode($res['displayImg']).'" class="rounded-circle img-fluid" style="width: 180px; class="d-block w-100">';
                                    }else{
                                        echo '<img  src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="rounded-circle img-fluid" style="width: 180px; class="d-block w-100">';
                                    }?>
                                </div>
                                <h4 class="mb-2"><?php echo $res['lName'].', '.$res['fName'];?></h4>
                                <p class="text-muted mb-5"><?php echo $res['agency'];?>&nbsp;Agency Inc.<br><?php echo $res['str'].', '.$res['brgy'].', '.$res['city'];?><br><a href="#!"><?php echo $res['email'];?></a></p>
                                <a class="btn btn-outline-light rounded-0" href='agentportfolio.php?agent=<?=$res['agent_ID']?>'>Go to profile</a>
                                        
                                <div class="d-flex justify-content-center text-center mt-5 mb-2">
                                    <div class="row align-items-start">
                                        <div class="col mb-3">
                                            <?php $numRate = (round(200 * ($res['prate'] / 5))/200)*100?>
                                            <div style="display: flex;">
                                                <div style="font-size: 20px;">User Rating:&nbsp;&nbsp;</div>
                                                <div class="star-ratings">
                                                    <p class="fill-ratings" style="width: <?=$numRate?>%;">
                                                        <span>★★★★★</span>
                                                    </p>
                                                    <p class="empty-ratings">
                                                        <span>★★★★★</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-muted"><?=$res['prate']?>  average based on <?=$res['total_rate']?> reviews.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <div class="second-div">
        <div class="container agent-hero">
            <div class="image-agent image-clipart">
                <img src="img/small/agent-license-clipart.png" alt="" width="500px">
            </div>
            <div class="content-agent content">
                <h1>Looking for an agent? Browse here!</h1>
                <h3 class="lead">The ultimate destination for your Real Estate Agent searching expedition. We are a comprehensive platform that gives users access to a comprehensive directory list of real estate brokers in Bataan.
                </h3>
                <button class="btn btn-outline-dark mt-2" href="#" onclick="window.location.href='agents.php'">View agents</button>
            </div>
        </div>
    </div>

    <div class="third-div">
        <div class="container property-hero">
            <div class="content-property content">
                <h1>Finding properties from legitimate agents?</h1>
                <h3 class="lead">We ease the process of selecting the right property because it can be time-consuming and overwhelming. We only feature properties sold by licensed real estate agents because we feel interacting with one is the key to a successful and stress-free property search.
                </h3>
                <button class="btn btn-outline-dark mt-2" href="#" onclick="window.location.href='properties.php'">View properties</button>
            </div>
            <div class="image-property image-clipart">
                <img src="img/small/property-clipart.png" alt="" width="500px">
            </div>
        </div>
    </div>

    <div class="fourth-div">
        <div class="container predict-hero">
            <div class="content-predict content">
                <h1>Or maybe you want to know your property's value?</h1>
                <h3 class="lead">Curious about the value of your property in the near future? Well, that is one of the features included in our website which is the Property Value Prediction. Whether you are buying, selling, or simply curious about the value of your home, our tool can provide you with valuable insights to help you make informed decisions.
                </h3>
                <button class="btn btn-outline-dark mt-2" href="#" onclick="window.location.href='assetvalue.php'">Try it now!</button>
            </div>
        </div>
    </div>
</main>



<script>
    <?php require_once 'js/index.js' ?>
</script>

<footer id="sticky-footer" class="sticky-footer flex-shrink-0 py-4">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>
