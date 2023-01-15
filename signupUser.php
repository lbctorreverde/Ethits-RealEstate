<?php
include_once 'navbarfresh.php'
?>

<style>
    <?php include 'css/signup.css'; ?>
</style>

<div class="main-div">
    <div>
        <form action="code.php" method="POST" class="container-fluid row g-3" id="signup-form">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@gmail.com">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="Enter Firstname here..">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="mname" placeholder="Enter Middlename here..">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Enter Lastname here..">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Birthday</label>
                <input type="date" class="form-control" name="bday">
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Sex</label>
                <select class="form-select" name="sex" id="sex">
                    <option value="" selected disabled>Select sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Phone Number</label>
                <input type="number" class="form-control" name="contact">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">City/Municipality</label>
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
            <div class="col-6">
                <label for="inputEmail4" class="form-label">Barangay</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Barangay">
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">House No., Street, Subdivision</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
</div>