<?php
include_once 'header.php';
include('dbconfig.php');
?>

<style>
    <?php include 'css/addproperty.css' ?>
</style>

<main role="main">
    <section class="topsection d-flex flex-column justify-content-center align-items-center">
        <i class="bi bi-house-door-fill"></i>
        <span class="display-5 mb-4">Add a property</span>
    </section>

    <section class="midsection">
        <!-- Button trigger modal -->

        <div class="properties-list container-fluid">
            <div class="add-btn">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Property
                </button>
            </div>
            <div class="container d-flex align-items-center justify-content-center mt-5">

                <div class="row gy-5">


                    <!-- Cabron, Here is what you duplicate -->
                    <div class="col-md-4">
                        <div class="card">
                            <svg xmlns="http://www.w3.org/2000/svg" type="button" width="40" height="40" fill="currentColor" data-bs-toggle="modal" data-bs-target="#exampleModalDelete" class="delete-btn bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                            </svg>

                            <div>
                                <img src="img/121vrq3gasfdg5.jpg" width="450" height="200" class="card-img-top" alt="First slide">
                            </div>
                            <div class="card-body shadow">
                                <form method="POST" action="properties.php" class="property-name-post d-flex form-control text-start">
                                    <input type="hidden" id="hide" name="hide" value="sadad">
                                    <button class="property-name-button" type="submit" id="btn_hide" name="btn_hide">
                                        <h5 class="card-title">sadasd</h5>
                                    </button>
                                </form>
                                <ul class="list-group list-group-flush">
                                    <span class="icon-livingsize"></span>
                                    <li class="list-group-item">
                                        <span><b>Land Size:</b>2323m²</span>
                                        <span><b>Status:</b><span class="text-success">adasd</span></span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Bathroom:</b>&nbsp;asadasd
                                        <b>Bedroom:</b>&nbsp;asdadsad
                                    </li>
                                    <li class="list-group-item">
                                        <b>Garage:</b>&nbsp;asdadsad
                                        <b>Basement:</b>&nbsp;adsasd
                                    </li>
                                    <li class="list-group-item">a</li>
                                    <li class="list-group-item text-muted">
                                        <p class="card-text"><small class="text-muted">asadasd</small></p>
                                    </li>
                                </ul>

                                <div class="card-footer text-muted" style="text-align: center;">
                                    <button onclick="window.location.href='login.php';">Buy</button>
                                </div>

                            </div>
                        </div>
                    </div>




                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="signcode.php" method="POST" class="container-fluid d-flex flex-column justify-content-center align-content-center" id="signup-form" enctype="multipart/form-data">

                                <div class="image-preview-container">
                                    <div class="preview">
                                        <img id="preview-selected-image" />
                                    </div>
                                    <label for="file-upload">Upload Image</label>
                                    <input type="file" id="file-upload" accept="image/*" onchange="previewImage(event);" />
                                </div>
                                <script>
                                    /**
                                     * Create an arrow function that will be called when an image is selected.
                                     */
                                    const previewImage = (event) => {
                                        /**
                                         * Get the selected files.
                                         */
                                        const imageFiles = event.target.files;
                                        /**
                                         * Count the number of files selected.
                                         */
                                        const imageFilesLength = imageFiles.length;
                                        /**
                                         * If at least one image is selected, then proceed to display the preview.
                                         */
                                        if (imageFilesLength > 0) {
                                            /**
                                             * Get the image path.
                                             */
                                            const imageSrc = URL.createObjectURL(imageFiles[0]);
                                            /**
                                             * Select the image preview element.
                                             */
                                            const imagePreviewElement = document.querySelector("#preview-selected-image");
                                            /**
                                             * Assign the path to the image preview element.
                                             */
                                            imagePreviewElement.src = imageSrc;
                                            /**
                                             * Show the element by changing the display value to "block".
                                             */
                                            imagePreviewElement.style.display = "block";
                                        }
                                    };
                                </script>
                                <input type="text" class="form-control my-2" id="exampleFormControlInput1" placeholder="Property Name">
                                <input type="text" class="form-control my-2" id="exampleFormControlInput1" placeholder="Property Address">

                                <div class="row my-2">
                                    <div class="col">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Land Size">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Bedroom(s)">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Bathroom(s)">
                                    </div>
                                </div>
                                <div class="row my-2 ms-5">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Garage</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Basement</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating my-2">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Special Features</label>
                                </div>
                                <div class="d-flex flex-column">
                                    <!-- to yung sa recaptcha -->
                                    <div class="g-recaptcha" data-sitekey="6LdomzgkAAAAABrqOnT1rX4Mnw59ezebiMQpSNir"></div>

                                    <button type="submit" name="btn_registerAgent" class="btn btn-dark mb-2">Add</button>
                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Delete BTN -->
            <div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            Are you sure you want to delete?
                        </div>
                        <div class="container-fluid d-flex flex-row justify-content-center align-items-center">
                            <!-- YES BUTUN PAR -->
                            <button type="submit" name="btn_registerAgent" class="btn-delete-cnfrm btn btn-danger mx-1">Yes</button>
                            <button type="button" class="btn-delete-cnfrm btn btn-outline-dark mx-1" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


</main>