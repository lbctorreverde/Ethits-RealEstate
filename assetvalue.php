<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/assetvalue.css' ?>
</style>

<div class="topsection">
    <div class="d-flex justify-content-center align-items-center text-center">
        <span class="result display-4 pt-2">Property Value Prediction</span>
    </div>
</div>

<div class="container-fluid">
    <div class="d-flex flex-row justify-content-center">
        <div class="row mx-2">
            <div class="d-flex justify-content-center">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <div class="row gy-2">
                            <div class="col-6">
                                <label for="" class="form-label">Square Footage (m²)</label>
                                <input type="number" class="form-control" aria-label="Square Footage">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Lot size (m²)</label>
                                <input type="number" class="form-control" aria-label="Lot size">
                            </div>
                            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                                <label for="exampleInputEmail1" class="form-label">Age (Years)</label>
                                <input type="number" class="form-control w-25" aria-label="First name">
                            </div>
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">Municipality</label>
                                <select id="disabledSelect" class="form-select">
                                    <option selected>Select Municipality</option>
                                    <option>Abucay</option>
                                    <option>Bagac</option>
                                    <option>Balanga</option>
                                    <option>Dinalupihan</option>
                                    <option>Hermosa</option>
                                    <option>Limay</option>
                                    <option>Mariveles</option>
                                    <option>Morong</option>
                                    <option>Orani</option>
                                    <option>Orion</option>
                                    <option>Pilar</option>
                                    <option>Samal</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <span>Number of: </span>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Garages</label>
                                <input type="number" class="form-control" aria-label="Square Footage">
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Bedrooms</label>
                                <input type="number" class="form-control" aria-label="Square Footage">
                            </div>
                            <div class="col">
                                <label for="" class="form-label">Bathrooms</label>
                                <input type="number" class="form-control" aria-label="Square Footage">
                            </div>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-outline-light w-100">Calculate</button>
                    </div>


                </div>

            </div>
        </div>
        <div class="d-flex align-items-center pe-3">
            <h1 class="text-light">=</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card shadow">
                <div class="card-body text-center">
                    <span class="fs-2">Result</span>
                </div>


            </div>

        </div>
    </div>





</div>