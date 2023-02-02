<?php
include_once 'header.php';
include('dbconfig.php');
?>

<style>
    <?php include 'css/propertycart.css' ?>
</style>


<section class="topsection d-flex justify-content-center align-items-center">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner rounded-2">
            <!-- Carousel for Cards every pending properties -->
            <div class="carousel-item active">
                <div class="card rounded">
                    <div class="row g-0">
                        <div class="property-img col-7">
                            <img src="img/wp2.jpg" class="property-img" alt="First slide" width="340" height="400">
                        </div>
                        <div class="col">
                            <div class="card-body container-fluid d-flex flex-column">
                                <h5 class="card-text">Rfo bungalow house and lot in bataan</h5>
                                <p class="card-text">Buyer name: <br>[insert Buyer name here]</p>
                                <p class="card-text"><small class="text-muted">ST. FRANCIS II, LIMAY</small></p>
                                <button type="button" class="btn-reject btn">Cancel</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End -->

            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon me-5" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon ms-5" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="table-section container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="topsearchbar">
        <form action="propertiescode.php" method="POST" role="search" id="form">
            <input type="search" id="query" name="searchProp" placeholder="Search..." aria-label="Search through site content">
            <?php
            $_SESSION['agentselected'] = "";
            ?>
            <select class="form-select" name="filter" id="filter" required>
                <option value="Title">Title</option>
                <option value="Bath">Bathroom</option>
                <option value="Bed">Bedroom</option>
                <option value="Sf">Special Features</option>
                <option value="Loc">Location</option>
            </select>
            <span class="vr me-3"></span>
            <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></button>
        </form>
    </div>
    <div class="property-table table-responsive">
        <table class="table align-middle mb-0 p-2 table-dark table-hover table-borderless rounded">
            <thead class="">
                <tr>
                    <th>Property Info</th>
                    <th>User Name</th>
                    <th>feedback</th>
                    <th>rate</th>
                    <th>trans_Date</th>
                    <th>doneDate</th>
                    <th>status_Trans</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center text-wrap">
                            <img src="img/test1.jpg" alt="" style="width: 170px; height: 130px" class="" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">Rfo bungalow house and lot in bataan</p>
                                <p class="text-muted mb-0">ST. FRANCIS II, LIMAY</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">Software engineer</p>
                    </td>
                    <td>
                        <span class="badge">Active</span>
                    </td>
                    <td>
                        <span class="badge">Active</span>
                    </td>
                    <td>
                        <span class="badge">YYYY:MM:DD</span>
                    </td>
                    <td>
                        <span class="badge">YYYY:MM:DD</span>
                    </td>
                    <td>
                        <span class="badge">Pending</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center text-wrap">
                            <img src="img/test2.jpg" alt="" style="width: 170px; height: 130px" class="" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">Property name</p>
                                <p class="text-muted mb-0">Property Address</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">Software engineer</p>
                    </td>
                    <td>
                        <span class="badge">Active</span>
                    </td>
                    <td>
                        <span class="badge">Active</span>
                    </td>
                    <td>
                        <span class="badge">YYYY:MM:DD</span>
                    </td>
                    <td>
                        <span class="badge">YYYY:MM:DD</span>
                    </td>
                    <td>
                        <span class="badge">Pending</span>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php
include_once 'footer.php';
?>