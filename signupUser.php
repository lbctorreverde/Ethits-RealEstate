<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
include_once 'navbarfresh.php'
?>

<style>
    <?php include 'css/signup.css'; ?>
</style>

<?php
    if (isset($_SESSION['status'])) {
        echo "<p class='alert alert-success'>" . $_SESSION['status'] . "</p>";
        unset($_SESSION['status']);
    }
?>

<div class="main-div">
    <div>
        <form action="signcode.php" method="POST" class="container-fluid row g-3" id="signup-form">
            <div class="text-top text-center">Sign up as a user</div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="Enter Firstname here.." required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Enter Lastname here.." required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Birthday</label>
                <input type="date" class="form-control" name="bday" required>
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">Sex</label>
                <select class="form-select" name="sex" id="sex" required>
                    <option value="" selected disabled>Select sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Phone Number</label>
                <input type="number" class="form-control" name="contact" maxlength="11" placeholder="0987654321" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Location</label>
                <select class="form-select" name="city" id="city" required>
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
                <input type="text" class="form-control" name="brgy" placeholder="Barangay" required>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="str" placeholder="1234 Main St">
            </div>
            <div class="d-flex col-12 justify-content-center">
                <div class="g-recaptcha" $id="g-recaptcha-response" data-sitekey="6LdomzgkAAAAABrqOnT1rX4Mnw59ezebiMQpSNir"></div> 
            </div>
            <div class="d-flex col-12 justify-content-center">
                <button type="submit" name="btn_registerUser" class="btn btn-primary">Sign up</button>
            </div>
            <a class="text-center " href="login.php">Already have an account? Sign in!</a>
        </form>
    </div>
</div>

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>
