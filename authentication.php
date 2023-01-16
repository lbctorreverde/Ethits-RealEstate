<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include('dbconfig.php');


if (isset($_SESSION['verified_user_id'])) {
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (\InvalidArgumentException $e) {
        echo 'The token could not be parsed: '.$e->getMessage();
        $_SESSION['expiry_status']  = "Session Expired/Invalid. Log-in Again";
        header('Location: login.php');
        exit();
    } catch (InvalidToken $e) {
        echo 'The token is invalid: '.$e->getMessage();
    }
}
else{
    $_SESSION['status']  = "Login to access this method";
    header('Location: login.php');
    exit();
}

?>