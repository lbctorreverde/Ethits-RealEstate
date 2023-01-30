<?php
include_once 'navbarfresh.php';
?>

<style>
    <?php include 'css/signup.css'; ?>
</style>

<div class="main-div d-flex align-items-center justify-content-center">
    <div>
        <form action="code.php" method="POST" class="container" id="signup-form">

            <div class="row">
                <div class="col">

                    <div class="row gy-2 p-3">
                        <div class="col-xs">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="col-xs">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fname" placeholder="Enter Firstname here..">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="mname" placeholder="Enter Middlename here..">
                        </div>
                        <div class="col-xs">
                            <label for="inputEmail4" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lname" placeholder="Enter Lastname here..">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="bday">
                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">Sex</label>
                            <select class="form-select" name="sex" id="sex">
                                <option value="" selected disabled>Select sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-xs">
                            <label for="inputEmail4" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="contact" placeholder="0987654321">
                        </div>

                    </div>
                </div>


                <div class="col">
                    <div class="row gy-3 p-3">
                        <div class="col-xs">
                            <label for="inputEmail4" class="form-label">Agency</label>
                            <input type="text" class="form-control" name="agency" placeholder="Enter Agency name here..">
                        </div>
                        <div class="col-xs">
                            <label for="inputEmail4" class="form-label">Location</label>
                            <select class="form-select" name="city" id="city">
                                <option value="" selected disabled>Select City</option>
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
                        <div class="col-xs">
                            <input type="text" class="form-control" name="brgy" placeholder="Barangay">
                        </div>
                        <div class="col-xs">
                            <input type="text" class="form-control" name="str" placeholder="1234 Main St">
                        </div>


                    </div>
                </div>
                <div class="container-fluid d-flex flex-column px-4">
                    <button type="submit" name="btn_registerAgent" class="btn btn-outline-light">Sign-Up</button>
                    <a class="text-center" href="login.php">Already have an account? Sign in!</a>
                </div>

        </form>

    </div>
</div>
</div>



</div>

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>