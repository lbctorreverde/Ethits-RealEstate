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

    <section>
        <div class="properties-list container-fluid">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Property
            </button>

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
        </div>
    </section>


</main>