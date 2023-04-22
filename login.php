<?php include_once 'navbarfresh.php'; ?>

<style>
    <?php include 'css/login.css'; ?>
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  function myFunction() {
  	var name = document.getElementById("alert")
    name.style.opacity = "0";
    setTimeout(function(){ name.style.display = "none"; }, 600);
  }
</script>
<?php
    if (isset($_SESSION['status'])) {?>
        <div style="position: absolute; z-index:1; width: auto; left:50%; transform: translate(-50%, -50%);" class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
            <?php echo $_SESSION['status'];?>
                <button type="button" class="close" data-dismiss="alert" onclick="myFunction()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['status']);
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
            <input type="email" name="email" placeholder="Email" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <a class="forgot-link" href="#">Forgot your password?</a>
            <button id="btn" type="submit" name="btn_loginUser">Log in</button>
            <a class="signupuser-link" href="signupUser.php">Don't have an account? Sign up now!</a>
            <div class="or-container"><div class="line-separator"></div> <div class="or-label">or</div><div class="line-separator"></div></div>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="logincode.php" method="POST">
            <h1>Sign in as Agent</h1>
            <?php
                if (isset($_SESSION['loginAgent'])) {
                    echo "<p style = 'color:red;'>" . $_SESSION['loginAgent'] . "</p>";
                    unset($_SESSION['loginAgent']);
                }
            ?>
            <input type="email" name="email" placeholder="Email" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <a class="forgot-link" href="#">Forgot your password?</a>
            <button id="btn" type="submit" name="btn_loginAgent">Log in</button>
            <a class="signup-link" href="signup.php">Don't have an account? Sign up now!</a>
            <div class="or-container"><div class="line-separator"></div> <div class="or-label">or</div><div class="line-separator"></div></div>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Are you an Agent?</h1>
                <p>Log in as an agent now to connect with clients!</p>
                <button id="btn" class="ghost" id="signIn">Log in as an agent</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Are you a user?</h1>
                <p>Log in as a user now to find the agent of your needs!</p>
                <button id="btn" class="ghost" id="signUp">Log in as a User</button>
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
