<?php
session_start();
include ('dbconfig.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if (isset($_POST["btn_registerAgent"])){
    if (isset($_POST["g-recaptcha-response"])) {
        $secretkey = "6LdomzgkAAAAABFxhxABI2usJ4kDG_sdCbGjwI9G";
        $response = $_POST["g-recaptcha-response"];
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
        $fire = file_get_contents($url);
        $data = json_decode($fire);
        if ($data->success == true) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $mname = $_POST["mname"];
            $bday = $_POST["bday"];
            $sex = $_POST["sex"];
            $contact = $_POST["contact"];
            $agency = $_POST["agency"];
            $city = $_POST["city"];
            $brgy = $_POST["brgy"];
            $str = $_POST["str"];
            $bpermit = addslashes(file_get_contents($_FILES['bpermit']['tmp_name'])) ?? "";
            $license = addslashes(file_get_contents($_FILES['license']['tmp_name'])) ?? "";
            $portfolio = addslashes(file_get_contents($_FILES['portfolio']['tmp_name'])) ?? "";

            $content = array($bpermit, $license , $portfolio);
        
            //Instantiation and passing `true` enables exceptions
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
                $mail->Password = 'dalnoddsbpkmybxf';
        
                //Enable TLS encryption;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
                //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 587;
        
                //Recipients
                $mail->setFrom('your_email@gmail.com', 'RealEstate:AgentFinder.com');
        
                //Add a recipient
                $mail->addAddress($email, $lname.", ".$fname);
        
                //Set email format to HTML
                $mail->isHTML(true);
        
                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        
                $mail->Subject = 'Email verification';
                $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        
                $mail->send();
                // echo 'Message has been sent';
        
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        
                // insert in users table
                $sql = "INSERT INTO tbl_agent(fName, lName, mName, email, password, token, email_verified_at, sex, bday, contactNo, agency, city, brgy, str, google_id, Status) 
                VALUES ('$fname','$lname','$mname', '$email', '$encrypted_password', '$verification_code', NULL, '$sex', '$bday'
                , '$contact', '$agency', '$city', '$brgy', '$str', NULL, 'Pending')";
                mysqli_query($connect, $sql);

                $query = "SELECT *  from tbl_agent WHERE email = '$email'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                $var = $row['agent_ID'];
                
                for ($i=0; $i <= sizeof($content)-1; $i++) { 
                    if($i == 0){
                        $label = 'bpermit';
                    }elseif ($i == 1) {
                        $label = 'license';
                    }elseif ($i == 2) {
                        $label = 'portfolio';
                    }
                    $sql = "INSERT INTO tbl_document(agent_ID, content, file, date_Time, doc_Status) 
                    VALUES ('$var','$label','$content[$i]',NOW(),'Pending')";
                    mysqli_query($connect, $sql);
                }

                header("Location: email-verification.php?email=" . $email);
            exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else {
            $_SESSION['status'] = "Please Fill Recaptcha";
            header('Location: signup.php');
            exit(); 
        }

        
    }else {
        $_SESSION['status'] = "Recaptcha Error";
        header('Location: signup.php');
        exit(); 
    }
}

if (isset($_POST["btn_registerUser"])){
    if (isset($_POST["g-recaptcha-response"])) {
        $secretkey = "6LdomzgkAAAAABFxhxABI2usJ4kDG_sdCbGjwI9G";
        $response = $_POST["g-recaptcha-response"];
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
        $fire = file_get_contents($url);
        $data = json_decode($fire);
        if ($data->success == true) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $bday = $_POST["bday"];
            $sex = $_POST["sex"];
            $contact = $_POST["contact"];
            $city = $_POST["city"];
            $brgy = $_POST["brgy"];
            $str = $_POST["str"];

            $content = array($bpermit, $license , $portfolio);
        
            //Instantiation and passing `true` enables exceptions
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
                $mail->Password = 'dalnoddsbpkmybxf';
        
                //Enable TLS encryption;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
                //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 587;
        
                //Recipients
                $mail->setFrom('your_email@gmail.com', 'RealEstate:AgentFinder.com');
        
                //Add a recipient
                $mail->addAddress($email, $lname.", ".$fname);
        
                //Set email format to HTML
                $mail->isHTML(true);
        
                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        
                $mail->Subject = 'Email verification';
                $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        
                $mail->send();
                // echo 'Message has been sent';
        
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        
                // insert in users table
                $sql = "INSERT INTO tbl_user(fName, lName, email, password, token, email_verified_at, sex, bday, contactNo, city, brgy, str, google_id, Status) 
                VALUES ('$fname','$lname', '$email', '$encrypted_password', '$verification_code', NULL, '$sex', '$bday'
                , '$contact', '$city', '$brgy', '$str', NULL, 'Pending')";
                mysqli_query($connect, $sql);

                header("Location: email-verificationUser.php?email=" . $email);
            exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else {
            $_SESSION['status'] = "Please Fill Recaptcha";
            header('Location: signupUser.php');
            exit(); 
        }

        
    }else {
        $_SESSION['status'] = "Recaptcha Error";
        header('Location: signupUser.php');
        exit(); 
    }
}

?>