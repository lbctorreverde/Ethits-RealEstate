<?php
// session_start();

// unset($_SESSION['verified_user_id']);
// unset($_SESSION['enduser']);
session_start();
session_unset();
session_destroy();

if(isset($_SESSION['expiry_status'])){
    $_SESSION['status'] = "Session Expired";
}else{
    $_SESSION['status']  = "Logged out successfully";
}
header('Location: login.php');
?>