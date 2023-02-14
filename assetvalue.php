<?php
include_once 'header.php';
?>

<style>
    <?php include 'css/assetvalue.css' ?>
</style>

<div class="topsection">
    <div class="d-flex justify-content-center align-items-center text-center">
        <span class="result display-4 pt-4">Property Value Prediction</span>
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
                                    <input type="number" id="sqm" class="form-control" aria-label="Square Footage" value="0">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Years:</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="years" class="form-control" aria-label="First name" value="0">
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-2">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input me-2" type="checkbox" id="ifResidence">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Residence</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Floors:</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="floors" class="form-control" aria-label="Square Footage" value="0" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Car Spaces:</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="garage" class="form-control" aria-label="Square Footage" value="0" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Bedrooms:</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="bedroom" class="form-control" aria-label="Square Footage" value="0" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="" class="form-label">Bathrooms:</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="bathroom" class="form-control" aria-label="Square Footage" value="0" disabled>
                                </div>
                            </div>
                            <div class="propertytype mt-2">
                                <select id="propertytype" onchange="duplex(event)" class="form-select" disabled>
                                    <option value="default" selected>Select Type</option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="Single-attached">Single-attached</option>
                                    <option value="Duplex">Duplex</option>
                                </select>
                            </div>
                            <hr>
                            <div class="municipality">
                                <select id="mun" class="form-select">
                                    <option value="default" selected>Select Municipality</option>
                                    <option value="Abucay">Abucay</option>
                                    <option value="Bagac">Bagac</option>
                                    <option value="Balanga">Balanga</option>
                                    <option value="Dinalupihan">Dinalupihan</option>
                                    <option value="Hermosa">Hermosa</option>
                                    <option value="Limay">Limay</option>
                                    <option value="Mariveles">Mariveles</option>
                                    <option value="Morong">Morong</option>
                                    <option value="Orani">Orani</option>
                                    <option value="Orion">Orion</option>
                                    <option value="Pilar">Pilar</option>
                                    <option value="Samal">Samal</option>
                                </select>
                            </div>

                            <hr>
                            <button type="button" class="btn btn-dark w-100 mb-2" onclick="calculate()">Calculate</button>
                            <button type="reset" class="btn btn-outline-dark w-100" onclick="">Reset</button>
                        </form>
                    </div>


                </div>

            </div>
        </div>
        <div class="d-flex align-items-center pe-3">
            <h1 class="text-light">=</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card shadow rounded-0">
                <div class="card-body text-center">
                    <span class="fs-2" id="result">&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="snackbar" class="toasterror">Invalid Input</div>

<script>
    <?php require_once 'js/assetvalue.js' ?>
</script>