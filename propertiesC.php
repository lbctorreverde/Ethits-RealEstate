<?php

session_start();
include ('dbconfig.php');

if (isset($_POST['btn_hide'])) {
    $hide = $_POST['hide'];
    if (isset($hide)) {
        $_SESSION['agentselected'] = $hide;
        header("Location: agentportfolio.php");
        exit(0);
    }
}
?>