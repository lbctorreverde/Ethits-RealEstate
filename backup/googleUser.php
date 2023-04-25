<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php 
session_start();
include_once 'dbconfig.php';
if(isset($_POST['btn_Agent'])){
    require 'google-api/vendor/autoload.php';
    // Creating new google client instance
    $client = new Google_Client();
    // Enter your Client ID
    $client->setClientId('819580286574-2u0sq7n53l1bbdfkiiv8oohuumir2a80.apps.googleusercontent.com');
    // Enter your Client Secrect
    $client->setClientSecret('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');
    // Enter the Redirect URL
    $client->setRedirectUri('http://localhost/agentFinder/Ethits-RealEState/googleUser.php');
    // Adding those scopes which we want to get (email & profile Information)
    $client->addScope("email");
    $client->addScope("profile");

    $client->createAuthUrl();


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
            $get_user = $connect->query("SELECT COUNT(google_id) as rowNum FROM `tbl_agent` WHERE `google_id`='$id'");
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
                $insert = mysqli_query($connect, "INSERT INTO `tbl_agent`(`google_id`,`fName`,`email`,`displayImg`) 
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
    
}

?>
