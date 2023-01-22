<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/properties.css' ?>
</style>

<section class="topsection d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-house-door-fill"></i>
    <span class="display-5 mb-4">Listed properties</span>
    <form action="agentscode.php" method="POST" role="search" id="form">
        <input type="search" id="query" name="searchName" placeholder="Search..." aria-label="Search through site content">

        <button type="submit" name="btn_search" class="searchbtn"><svg viewBox="0 0 1024 1024"></svg></button>
        <!-- Filter Button -->
        <button type="button" class="filter-btn btn btn-dark" data-bs-toggle="modal" data-bs-target='#exampleModal' onclick="myModal.show()">Filter</button>
    </form>
</section>

<section class="properties-section">
    <div class="properties-list container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <div class="col">
                <div class="card ">
                    <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x5x880x450/e40a1e75b071ab.webp" class="card-img-top" alt="...">
                    <div class="card-body shadow">
                        <h5 class="card-title">L-S-1-201604-13- Acquired Property</h5>
                        <ul class="list-group list-group-flush">
                            <span class="icon-livingsize"></span>
                            <li class="list-group-item"><span><b>Floor Area:</b> 60 m²</span></li>
                            <li class="list-group-item"><b>Land Size:</b> 110 m²</li>
                            <li class="list-group-item text-muted">
                                <p class="card-text"><small class="text-muted">Block 1, Lot 8, Diamond St., EMERALD COAST EXECUTIVE VILLAGE, Brgy. Peas/Duale, Limay, Bataan</small></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/2x2x6x1200x900/8c52bffefc993b.webp" class="card-img-top" alt="...">
                    <div class="card-body shadow">
                        <h5 class="card-title ">L-R-1-762- Acquired Property</h5>
                        <ul class="list-group list-group-flush">
                            <span class="icon-livingsize"></span>
                            <li class="list-group-item"><span><b>Floor Area:</b> 282 m²</span></li>
                            <li class="list-group-item"><b>Land Size:</b> 240 m²</li>
                            <li class="list-group-item text-muted">
                                <p class="card-text"><small class="text-muted">Lot 4, Block 6, Magnolia Street, Venzon Subdivision, Brgy. Cupang North, Balanga City, Bataan</small></p>
                            </li>
                        </ul>
                        <p class="card-text text-muted fs-6 lead"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>