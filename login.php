<?php include_once 'navbarfresh.php';?>

<style>
    <?php include 'css/login.css'; ?>
</style>

<?php
    if(isset($_SESSION['status']))
    {
        echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
        unset($_SESSION['status']);
    }
?>

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="logincode.php" method="POST">
            <h1>Sign is as User</h1>
            <?php
                if(isset($_SESSION['loginUser'])){
                    echo "<p style = 'color:red;'>".$_SESSION['loginUser']."</p>";
                    unset($_SESSION['loginUser']);
                }
            ?>
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="pass" placeholder="Password" />
            <a class="forgot-link" href="#">Forgot your password?</a>
            <button type="submit" name="btn_loginUser">Log in</button>
            <a class="signupuser-link" href="signupUser.php">Don't have an account? Sign up now!</a>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="logincode.php" method="POST">
            <h1>Sign in as Agent</h1>
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="pass" placeholder="Password" />
            <a class="forgot-link" href="#">Forgot your password?</a>
            <button type="submit" name="btn_login" class="btn btn-primary">Log-in</button>

        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Are you an Agent?</h1>
                <p>Log in as an agent now to connect with clients!</p>
                <button class="ghost" id="signIn">Log in as an agent</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Are you a user?</h1>
                <p>Log in as a user now to find the agent of your needs!</p>
                <button class="ghost" id="signUp">Log in as a User</button>
            </div>
            
        </div>
    </div>
</div>

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class=" text-center">
        <small>Copyright &copy; CS3</small>
    </div>
</footer>




<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
