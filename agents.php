<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/agents.css'; ?>
</style>


<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1>Find your agent on this page</h1>
</section>

<form role="search" id="form">
    <input type="search" id="query" name="q" placeholder="Search..." aria-label="Search through site content">
    <button class="searchbtn"><svg viewBox="0 0 1024 1024">
            <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
        </svg></button>
    <!-- Filter Button -->
    <button type="button" class="filter-btn btn btn-dark" data-bs-toggle="modal" data-bs-target='#exampleModal' onclick="myModal.show()">Filter</button>

</form>



<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4>Total agents</h4>
        <p>[replace with number of agent]</p>
    </div>
    <div class="agentslist-panel">

        <!-- CARD FOR EACH AGENT PAR-->
        <div class="agentcard row g-0 mt-2 shadow">
            <div class="col-md-2">
                <img src="img/121vrq3gasfdg5.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Paiba nalang, sa notfound.php pa redirect nya eh -->
                    <a class="text-decoration-none text-reset" onclick="window.location.href='notfound.php';">Full name ng Agent</a>
                    <p class="card-text text-muted">Pangalan ng agency na pinapasukan ahaha ;)</p>
                    <p class="card-title text-muted">Contact: </p>
                    <p class="card-text"><small class="text-muted lh-sm">09123456789</small></p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container-fluid d-flex flex-column modal-body justify-content-center">
                <div class="col-md-6 mb-2">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder=" " style="width: 32vh;">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="inputEmail4" class="form-label">Agency</label>
                    <input type="text" class="form-control" name="agency" placeholder=" " style="width: 32vh;">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="inputEmail4" class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" placeholder=" " style="width: 32vh;">
                </div>
                <button type="button" class="btn btn-dark mt-3">Reset</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
</script>