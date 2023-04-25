<?php include_once 'navbarfresh.php'; ?>
<?php include_once 'dbconfig.php'; ?>
<style>
    <?php include 'css/login.css'; ?> 
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function showPass() {
        var aPass = document.getElementById("passAgent");
        var uPass = document.getElementById("passUser");
        if (aPass.type == "password" || uPass.type == "password" ) {
            aPass.type = "text";
            uPass.type = "text";
        } else {
            aPass.type = "password";
            uPass.type = "password";
        }
    }
</script>

<?php
if(isset($_POST['btn_Agent'])){
    $_SESSION['session'] = 'tbl_agent';?>
    <script>
        location.href = <?=$client->createAuthUrl();?>;
    </script>
<?php }


require 'google-api/vendor/autoload.php';
// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId('819580286574-2u0sq7n53l1bbdfkiiv8oohuumir2a80.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/agentFinder/Ethits-RealEState/login.php');
// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");
if(isset($_GET['code'])):
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);
        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($connect, $google_account_info->id);
        $full_name = mysqli_real_escape_string($connect, trim($google_account_info->name));
        $email = mysqli_real_escape_string($connect, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($connect, $google_account_info->picture);
        // checking user already exists or not
        $table = $_SESSION['session'];
        $get_user = $connect->query("SELECT COUNT(google_id) as rowNum FROM '$table' WHERE `google_id`='$id'");
        $result  = $get_user->fetch_assoc(); 
        $rowCount= $result['rowNum']; 
        echo $rowCount;
        if($rowCount == 0){
            $_SESSION['login_id'] = $id;
            $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['verified_user_id'] = $email;
            $_SESSION['user_ID'] = $row['user_ID'];
            $_SESSION['enduser'] = 'User';
            $_SESSION['status'] = "Login Successfully";?>
            <script>
                location = 'index.php';
                exit;
            </script>
        <?php 
        }else{
            // if user not exists we will insert the user
            $insert = mysqli_query($connect, "INSERT INTO '$table' (`google_id`,`fName`,`email`,`displayImg`) 
            VALUES('$id','$full_name','$email','$profile_pic')");
            if($insert){
                $_SESSION['login_id'] = $id;?>
                <script>
                    location = 'index.php';
                    exit;
                </script>
            <?php }
            else{
                echo "Sign up failed!(Something went wrong).";
            }
        }
    }
    else{
        header('Location: login.php');
        exit;
    }
    
else: 
    // Google Login Url = $client->createAuthUrl(); 



?>
<style>
    .myInput {
        width: 285px; /* Full-width */
        font-size: 15px; /* Increase font-size */
        padding: 10px;
        border-radius: 10px;
        background-color: white; 
        border: 1px solid #ddd;
    }

    .myInput:hover{
        background-color: whitesmoke;
    }
</style>
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
        <h2><b>Sign is as User</b></h2>
        <?php
            if(isset($_SESSION['loginUser'])){
                echo "<p style = 'color:red;'>".$_SESSION['loginUser']."</p>";
                unset($_SESSION['loginUser']);
            }
        ?>
        <form action="logincode.php" class="formcss" method="POST">
            <input type="email" name="email" placeholder="Email" required/>
            <input type="password" name="password" id="passUser" placeholder="Password" required/>
            <div class="gridhz">
                <div style="display:flex; margin-top:1px; font-size:14px;">
                    <input type="checkbox" style="width:15px; cursor: pointer;" id="checkU" onclick="showPass()">&nbsp;&nbsp;
                    <div style="margin-top: 14px;">Show Password</div>
                </div>
                <a class="forgot-link" style="font-size:14px;" href="reset.php">Forgot your password?</a>
            </div>
            <button id="btn_loginUser" class="ghost" type="submit" name="btn_loginUser">Log in</button>
            <a class="signupuser-link" href="signupUser.php">Don't have an account? Sign up now!</a>
        </form>
        <div style="margin-top:10px; margin-bottom:10px; color:gray;">or</div>
        <form action="logincode.php" method="POST">
            <a style="text-decoration: none; color: black;" onclick="" type="button" href="<?php echo $client->createAuthUrl(); ?>">
                <!-- <img src="img/google.png" style="object-fit:fill; width: 300px; height: 50px;"> -->
                <div class="myInput"><img src="img/gIcon.png" style="object-fit:fill; width: 25px; height: 25px; transform:translate(-50px,0);">Sign in with Google</div>
            </a>
        </form>
                
    </div>
    <div class="form-container sign-in-container">
        <h2><b>Sign in as Agent</b></h2>
        <?php
            if (isset($_SESSION['loginAgent'])) {
                echo "<p style = 'color:red;'>" . $_SESSION['loginAgent'] . "</p>";
                unset($_SESSION['loginAgent']);
            }
        ?>
        <form action="logincode.php" class="formcss" method="POST">
            <input type="email" name="email" placeholder="Email" required/>
            <input type="password" name="password" id="passAgent" placeholder="Password" required/>
            <div class="gridhz">
                <div style="display:flex; margin-top:1px; font-size:14px;">
                    <input type="checkbox" style="width:15px; cursor: pointer;" id="checkA" onclick="showPass()">&nbsp;&nbsp;
                    <div style="margin-top: 14px;">Show Password</div>
                </div>
                <a class="forgot-link" style="font-size:14px;" href="reset.php">Forgot your password?</a>
            </div>
            <button id="btn_loginAgent" class="ghost" type="submit" name="btn_loginAgent">Log in</button>
            <a class="signup-link" href="signup.php">Don't have an account? Sign up now!</a>
        </form>
        <div style="margin-top:10px; margin-bottom:10px; color:gray;">or</div>
        <form action="googleUser.php" method="POST">
            <button class="myInput" style="text-decoration: none; color: black; " id="btn_Agent" name="btn_Agent" type="submit">
                <div><img src="img/gIcon.png" style="object-fit:fill; width: 25px; height: 25px; transform:translate(-50px,0);">Sign in with Google</div>
            </button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Are you an Agent?</h1>
                <p>Log in as an agent now to connect with clients!</p>
                <button  class="ghost" id="signIn">Log in as an agent</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Are you a user?</h1>
                <p>Log in as a user now to find the agent of your needs!</p>
                <button  class="ghost" id="signUp">Log in as a User</button>
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


    $('#signUp').click(function() {
        container.classList.add("right-panel-active");
        document.getElementById("checkA").checked = false;
        document.getElementById("checkU").checked = false;
    });

    $('#signIn').click(function() {
        container.classList.remove("right-panel-active");
        document.getElementById("checkA").checked = false;
        document.getElementById("checkU").checked = false;
    });

</script>

<?php endif; ?>