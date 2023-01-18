<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include ('dbconfig.php');

//SIGN UP AGENT
if(isset($_POST['btn_login'])){

    $email = $_POST['email'];
    $clearTextPassword = $_POST['pass'];

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
                
                $_SESSION['status'] = "Logged in successfully".$uid;
                header('Location: index.php');
                exit();

            } catch (\InvalidArgumentException $e) {
                echo 'The token could not be parsed: '.$e->getMessage();
            } catch (InvalidToken $e) {
                echo 'The token is invalid: '.$e->getMessage();
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
    
    $createdUser = $auth->createUser($userProperties);
    // $ref_table = "/agentInfo";
    // $database->getReference($ref_table)->set($userProperties);

    if($createdUser){
        $_SESSION['status'] = "User Created/Registered Successfully";
        header('Location: login.php');
        exit;
    }else{
        $_SESSION['status'] = "User Not Created/Registered";
        header('Location: login.php');
        exit;
    }
    
}

?>

