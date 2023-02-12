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

    <div class="container-fluid topagents-div">
        <h1 class="header">Top Agents</h1>
        <div id="carouselExampleControls" class=" carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner agents-carousel">

                <!-- 


                FIRST 
                THREE 
                AGENTS 


                 -->
                <div class="carousel-item active">
                    <div class="row row-cols-3">
                        <div class="col">
                            <div class="card agent-card">
                                <div class="card-body text-center">
                                    <div class="mt-3 mb-4">
                                        <img src="img/121vrq3gasfdg5.jpg" class="rounded-circle img-fluid" style="width: 180px;" />
                                    </div>
                                    <h4 class="mb-2">Agent's Name</h4>
                                    <p class="text-muted mb-5">Agency Incorporated Association<br><a href="#!">email@email.com</a></p>

                                    <button type="button" class="btn btn-outline-light rounded-0">
                                        Go to profile
                                    </button>
                                    <div class="d-flex justify-content-center text-center mt-5 mb-2">
                                        <div>
                                            <p class="mb-2 h5">87%</p>
                                            <p class="text-muted mb-0">Rating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card agent-card">
                                <div class="card-body text-center">
                                    <div class="mt-3 mb-4">
                                        <img src="img/121vrq3gasfdg5.jpg" class="rounded-circle img-fluid" style="width: 180px;" />
                                    </div>
                                    <h4 class="mb-2">Agent's Name</h4>
                                    <p class="text-muted mb-5">Agency Incorporated Association<br><a href="#!">email@email.com</a></p>
                                    <button type="button" class="btn btn-outline-light rounded-0">
                                        Go to profile
                                    </button>
                                    <div class="d-flex justify-content-center text-center mt-5 mb-2">
                                        <div>
                                            <p class="mb-2 h5">87%</p>
                                            <p class="text-muted mb-0">Rating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card agent-card">
                                <div class="card-body text-center">
                                    <div class="mt-3 mb-4">
                                        <img src="img/121vrq3gasfdg5.jpg" class="rounded-circle img-fluid" style="width: 180px;" />
                                    </div>
                                    <h4 class="mb-2">Agent's Name</h4>
                                    <p class="text-muted mb-5">Agency Incorporated Association<br><a href="#!">email@email.com</a></p>
                                    <button type="button" class="btn btn-outline-light rounded-0">
                                        Go to profile
                                    </button>
                                    <div class="d-flex justify-content-center text-center mt-5 mb-2">
                                        <div>
                                            <p class="mb-2 h5">87%</p>
                                            <p class="text-muted mb-0">Rating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 
                    
                
                LOOP TO INSERT MORE AGENTS 
                

                -->
                <div class="carousel-item">
                    <div class="row row-cols-3">
                        <div class="col">
                            <div class="card agent-card">
                                <div class="card-body text-center">
                                    <div class="mt-3 mb-4">
                                        <img src="img/121vrq3gasfdg5.jpg" class="rounded-circle img-fluid" style="width: 180px;" />
                                    </div>
                                    <h4 class="mb-2">Agent's Name</h4>
                                    <p class="text-muted mb-5">Agency Incorporated Association<br><a href="#!">email@email.com</a></p>
                                    <button type="button" class="btn btn-outline-light rounded-0">
                                        Go to profile
                                    </button>
                                    <div class="d-flex justify-content-center text-center mt-5 mb-2">
                                        <div>
                                            <p class="mb-2 h5">87%</p>
                                            <p class="text-muted mb-0">Rating</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container second-div">
            <div>

                <div class="image-agent">
                    <img src="img/small/agent-license-clipart.png" alt="" width="500px">
                </div>

                <div class="content-agent content">
                    <h1>Looking for an agent? Browse here!</h1>
                    <h3 class="lead">The ultimate destination for your Real Estate Agent searching expedition. We are a comprehensive platform that gives users access to a comprehensive directory list of real estate brokers in Bataan.
                    </h3>
                    <button class="btn btn-outline-light mt-2" href="#" onclick="window.location.href='agents.php'">View agents</button>
                </div>

            </div>



        </div>
    </div>




    <div class="container third-div">
        <div>
            <div class="image-property">
                <img src="img/small/property-clipart.png" alt="" width="500px">
            </div>

            <div class="content-property content">
                <h1>Or maybe finding properties from legitimate agents?</h1>
                <h3 class="lead">The ultimate destination for your Real Estate Agent searching expedition. We are a comprehensive platform that gives users access to a comprehensive directory list of real estate brokers in Bataan.
                </h3>
                <button class="btn btn-outline-light mt-2" href="#" onclick="window.location.href='properties.php'">View properties</button>
            </div>
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