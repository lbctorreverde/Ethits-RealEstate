<?php

session_start();
include ('dbconfig.php');

if(isset($_POST["btn_search"])){
    $searchN = $_POST['searchName'];

    $_SESSION['searchName'] = $searchN;

// $getdata = $database->getReference('agentInfo')->orderByChild('firstName')->startAt('Jay')->getValue();
$getdata = $database->getReference('agentInfo')->orderByChild("lastName")->getValue();

$filtered = array_filter($getdata, function (array $userData) {
    $lastN = $userData['lastName'] ?? '';
    $firstN = $userData['firstName'] ?? '';
    $midN = $userData['midName'] ?? '';
    $agency = $userData['agency'] ?? '';
    $str = $userData['str'] ?? '';
    $brgy = $userData['brgy'] ?? '';
    $city = $userData['city'] ?? '';

    return stripos($lastN, $_SESSION['searchName']) !== false OR stripos($firstN, $_SESSION['searchName']) !== false OR stripos($midN, $_SESSION['searchName']) !== false
    OR stripos($agency, $_SESSION['agency']) !== false OR stripos($str, $_SESSION['locC']) 
    !== false OR stripos($brgy, $_SESSION['locC']) !== false OR stripos($city, $_SESSION['locC']) !== false;
});

$_SESSION['searchName'] = $filtered;

$database->getReference('agentInfo')->orderByChild("lastName")->getValue();
header("Location: agents.php");
exit(0);

}

elseif (isset($_POST["btn_filter"])) {
    $_SESSION['searchName'] ="";
    $filterAgency = $_POST['agency'];
    $filterName = $_POST['name'];
    $filterLocC = $_POST['loccity'];

    $_SESSION['agency'] = $filterAgency;
    $_SESSION['locC'] = $filterLocC;
    $_SESSION['filterName'] = $filterName;

    if ($_SESSION['agency'] == "") {
        $_SESSION['agency'] = " ";
    }else {
        $_SESSION['agency'] = $filterAgency;
    }

    if ($_SESSION['locC'] == "") {
        $_SESSION['locC'] = " ";
    }else {
        $_SESSION['locC'] = $filterLocC;
    }

    if ($_SESSION['filterName'] == "") {
        $_SESSION['filterName'] = " ";
    }else {
        $_SESSION['filterName'] = $filterName;
    }
    

// $getdata = $database->getReference('agentInfo')->orderByChild('firstName')->startAt('Jay')->getValue();
$getdata = $database->getReference('agentInfo')->orderByChild("lastName")->getValue();

$filtered = array_filter($getdata, function (array $userData) {
    $lastN = $userData['lastName'] ?? '';
    $firstN = $userData['firstName'] ?? '';
    $midN = $userData['midName'] ?? '';
    $agency = $userData['agency'] ?? '';
    $str = $userData['str'] ?? '';
    $brgy = $userData['brgy'] ?? '';
    $city = $userData['city'] ?? '';

    return stripos($lastN, $_SESSION['filterName']) !== false || stripos($firstN, $_SESSION['filterName']) !== false || stripos($midN, $_SESSION['filterName']) !== false
    || stripos($agency, $_SESSION['agency']) !== false || stripos($city, $_SESSION['locC']) !== false || stripos($brgy, $_SESSION['locC']) !== false
    || stripos($str, $_SESSION['locC']) !== false;

});

$_SESSION['searchName'] = $filtered;

header("Location: agents.php");
exit(0);
}


?>