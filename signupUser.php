<?php
include_once 'navbarfresh.php'
?>

<style>
    <?php include 'css/signup.css'; ?>
</style>

<div class="main-div">
    <div>
        <form action="code.php" method="POST" class="container-fluid row g-3" id="signup-form">
            <div class="text-top text-center">Sign up as a user</div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@gmail.com">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="Enter Firstname here..">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Enter Lastname here..">
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
