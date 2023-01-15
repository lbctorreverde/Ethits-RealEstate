<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include ('dbconfig.php');
//LOGIN AGENT
if(isset($_POST['btn_loginAgent'])){

    $email = $_POST['email'];
    $clearTextPassword = $_POST['pass'];

    if ($email == "") {
        $_SESSION['loginAgent'] = "Email is required";
        header('Location: login.php');
        exit();
    }elseif ($clearTextPassword == ""){
        $_SESSION['loginAgent'] = "Password is Empty";
        header('Location: login.php');
        exit();
    }else{
        try {
            $user = $auth->getUserByEmail($email);

            try{
                $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                //$idTokenString = $signInResult->idToken();
                $idTokenString = $signInResult->idToken();
                
                try {
                    $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                    $uid = $verifiedIdToken->claims()->get('sub');
                    // $signInResult->firebaseUserId(); 

                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;

                    $reference = $database->getReference('agentInfo/'.$uid);
                    $snapshot = $reference->getSnapshot()->exists();
                    if (isset($snapshot)) {
                        $_SESSION['enduser'] = 'Agent';
                    }
                    
                    $_SESSION['status'] = "Logged in successfully";
                    header('Location: index.php');
                    exit();

                } catch (\InvalidArgumentException $e) {
                    echo 'The token could not be parsed: '.$e->getMessage();
                    $_SESSION['status']  = "Wrong Password";
                    header('Location: login.php');
                    exit();
                } catch (InvalidToken $e) {
                    echo 'The token is invalid: '.$e->getMessage();
                    $_SESSION['status']  = "Wrong Password";
                    header('Location: login.php');
                    exit();
                }

            }catch (Exception $e) {
                # code...
                $_SESSION['status']  = "Wrong Password";
                header('Location: login.php');
                exit();
            }

        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            //echo $e->getMessage();
            
        }
    }

}

//LOGIN USER
if(isset($_POST['btn_loginUser'])){

    $email = $_POST['email'];
    $clearTextPassword = $_POST['pass'];

    if ($email == "") {
        $_SESSION['loginUser'] = "Email is required";
        header('Location: login.php');
        exit();
    }elseif ($clearTextPassword == ""){
        $_SESSION['loginUser'] = "Password is Empty";
        header('Location: login.php');
        exit();
    }else{
        try {
            $user = $auth->getUserByEmail($email);

            try {
                $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                //$idTokenString = $signInResult->idToken();
                $idTokenString = $signInResult->idToken();

                try {
                    $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                    $uid = $verifiedIdToken->claims()->get('sub');
                    // $signInResult->firebaseUserId(); 

                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;

                    $reference = $database->getReference('userInfo/' . $uid);
                    $snapshot = $reference->getSnapshot()->exists();
                    if (isset($snapshot)) {
                        $_SESSION['enduser'] = 'User';
                    }

                    $_SESSION['status'] = "Logged in successfully";
                    header('Location: index.php');
                    exit();

                } catch (\InvalidArgumentException $e) {
                    echo 'The token could not be parsed: ' . $e->getMessage();
                    $_SESSION['status'] = "Wrong Password";
                    header('Location: login.php');
                    exit();
                } catch (InvalidToken $e) {
                    echo 'The token is invalid: ' . $e->getMessage();
                    $_SESSION['status'] = "Wrong Password";
                    header('Location: login.php');
                    exit();
                }

            } catch (Exception $e) {
                # code...
                $_SESSION['status'] = "Wrong Password";
                header('Location: login.php');
                exit();
            }

        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            //echo $e->getMessage();

        }
    }
}

?>

