<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/agents.css'; ?>
</style>


<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1>Agents ahahahahaha ;)</h1>
</section>

<form role="search" id="form">
    <input type="search" id="query" name="q" placeholder="Search..." aria-label="Search through site content">
    <button class="searchbtn"><svg viewBox="0 0 1024 1024">
            <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
        </svg></button>
</form>

<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4>Total agents</h4>
    </div>
    <div class="agentslist-panel">
        <!-- CARD FOR EACH AGENT -->
        <div class="agentcard row g-0 mt-2 shadow">
            <div class="col-md-2">
                <img src="img/121vrq3gasfdg5.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title mt-2">Full name ng Agent</h5>
                    <p class="card-text text-muted">Pangalan ng agency na pinapasukan ahaha ;)</p>
                    <p class="card-title text-muted">Contact: </p>
                    <p class="card-text"><small class="text-muted lh-sm">09123456789</small></p>
                </div>
            </div>
        </div>

        


    </div>
</section>

