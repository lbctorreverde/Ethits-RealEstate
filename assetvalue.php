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
    <div class="d-flex flex-row justify-content-center ">
        <div class="row mx-2">
            <div class="d-flex justify-content-center align-content-center">
                <div class="card shadow rounded-0">
                    <div class="card-body">
                        <form>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Square Footage (m²):</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="Square Footage" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Lot size (m²):</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="Lot size" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Age (Years):</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="First name" value="0">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Garages:</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="Square Footage" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Bedrooms:</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="Square Footage" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Bathrooms:</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" aria-label="Square Footage" value="0">
                                </div>
                            </div>
                            <hr>
                            <div class="municipality">
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
                            <hr>
                            <button type="button" class="btn btn-dark w-100">Calculate</button>
                        </form>
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