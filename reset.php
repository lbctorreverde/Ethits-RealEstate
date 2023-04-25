<?php
include_once 'navbarfresh.php';
include 'dbconfig.php';

?>

<style>
    .box{
        background-color: white;
        margin-top: 150px;
        width: 550px;
        height: 350px;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
        padding-top: 20px;
        text-align: center;
    }
</style>
<?php 
  if (isset($_SESSION['status'])) {
    echo "<p class='alert alert-success'>" . $_SESSION['status'] . "</p>";
    unset($_SESSION['status']);
    }
?>

<div class="main-div d-flex align-items-center justify-content-center">
    <div class="box">
        <h4>Reset Password</h4><hr>
        <div>
            <form method="POST">
            <div style="margin-top: 40px;" class="form-group row">
                <div>
                    Enter Email to request code to update password.
                </div>
                <label style="margin-top: 30px;" for="inputEmail3" class="col-sm-3 col-form-label">Email:</label>
                <div style="margin-top: 30px;" class="col-sm-8">
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div style="margin-top: 20px;" class="d-flex col-20 justify-content-center">
                    <button name="btn_send" id="btn_send" class="btn btn-dark" style="display: block;">Send Request</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST["btn_send"])) {
    $email = $_POST['email'];
    
    $query = $connect->query("SELECT email,lName FROM tbl_agent WHERE email='$email' 
    UNION SELECT email,lName FROM tbl_user WHERE email='$email';");
    $res = $query->fetch_assoc();
    $mail = new PHPMailer(true);
                
    try {
        //Enable verbose debug output
        $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

        //Send using SMTP
        $mail->isSMTP();

        //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;

        //SMTP username
        $mail->Username = 'sntsjzh353@gmail.com';

        //SMTP password
        $mail->Password = 'rscvoerlsretjtkp';

        //Enable TLS encryption;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('your_email@gmail.com', 'RealEstate:AgentFinder.com');

        //Add a recipient
        $mail->addAddress($email);

        //Set email format to HTML
        $mail->isHTML(true);


        $mail->Subject = 'Reset Password';
        $mail->Body    = '<p>Hi '.$res['lName'].',
        <br><br>You recently requested to reset the password for your '.$res['email'].' account. Click the link below to proceed.
        <br><br><b><a href="http://localhost/agentFinder/Ethits-RealEState/changepass.php?email='.$res['email'].'">http://localhost/agentFinder/Ethits-RealEState/changepass.php?email='.$res['email'].'</a></b>
        <br><br>If you did not request a password reset, please ignore this email.
        <br><br>Thanks, the <b>RE:AgentFinder</b> team</p>';

        $mail->send();
        // echo 'Message has been sent';

        ?>
        <script>
            alert('Request Sent, please check your email to proceed.')
            location = 'login.php';
            exit;
        </script>
        <?php
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


