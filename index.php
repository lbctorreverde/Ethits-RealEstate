<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/index.css' ?>
</style>

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

    <div class="container-fluid second-div text-center">
        <div>
            <div class="image-agent">
                <img src="img/small/agent-license-clipart.png" alt="" height="200px">
            </div>
            <div class="content-agent content">
                <h1>Looking for an agent? Browse here!</h1>
                <button class="btn btn-outline-light mt-2">View agents</button>
            </div>

        </div>
    </div>

    <div class="container-fluid third-div text-center">
        <div>
            <div class="image-property">
                <img src="img/small/property-clipart.png" alt="" height="170px">
            </div>
            <div class="content-property content">
                <h1>Looking for an agent? Browse here!</h1>
                <button class="btn btn-outline-light mt-2">View properties</button>
            </div>

        </div>
    </div>





</main>



<script>
    <?php require_once 'js/index.js' ?>
</script>

<?php
include_once 'footer.php';
?>