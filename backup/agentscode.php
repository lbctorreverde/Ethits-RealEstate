<?php

session_start();
include ('dbconfig.php');

if(isset($_POST["btn_search"])){
    $searchN = $_POST['searchName'];
    $filter = $_POST['filter'];
    $_SESSION['searchName'] = $searchN;


    $getdata = $database->getReference('agentInfo')->orderByChild("lastName")->startAt($searchN)->getValue();
    
// $getdata = $database->getReference('agentInfo')->orderByChild('firstName')->startAt('Jay')->getValue();



$filtered = array_filter($getdata, function (array $userData) {
    $filter = $_POST['filter'];
    $searchN = $_POST['searchName'];
    $lastN = $userData['lastName'] ?? '';
    $firstN = $userData['firstName'] ?? '';
    $midN = $userData['midName'] ?? '';
    $agency = $userData['agency'] ?? '';
    $str = $userData['str'] ?? '';
    $brgy = $userData['brgy'] ?? '';
    $city = $userData['city'] ?? '';

    if ($filter == 'Name') {
        return stripos($lastN, $searchN) !== false OR stripos($firstN, $searchN) !== false OR stripos($midN, $searchN) !== false;
    }elseif ($filter == 'Agency') {
        return stripos($agency, $searchN) !== false;
    }elseif ($filter == 'Location') {
        return stripos($city, $searchN) !== false OR stripos($brgy, $searchN) !== false OR stripos($str, $searchN) !== false;
    }
});

$_SESSION['searchName'] = $filtered;

$database->getReference('agentInfo')->orderByChild("lastName")->getValue();
header("Location: agents.php");
exit(0);

}

// elseif (isset($_POST["btn_filter"])) {
//     $_SESSION['searchName'] ="";
//     $filterAgency = $_POST['agency'];
//     $filterName = $_POST['name'];
//     $filterLocC = $_POST['loccity'];

//     $_SESSION['agency'] = $filterAgency;
//     $_SESSION['locC'] = $filterLocC;
//     $_SESSION['filterName'] = $filterName;

//     if ($_SESSION['agency'] == "") {
//         $_SESSION['agency'] = " ";
//     }else {
//         $_SESSION['agency'] = $filterAgency;
//     }

//     if ($_SESSION['locC'] == "") {
//         $_SESSION['locC'] = " ";
//     }else {
//         $_SESSION['locC'] = $filterLocC;
//     }

//     if ($_SESSION['filterName'] == "") {
//         $_SESSION['filterName'] = " ";
//     }else {
//         $_SESSION['filterName'] = $filterName;
//     }
    

// // $getdata = $database->getReference('agentInfo')->orderByChild('firstName')->startAt('Jay')->getValue();
// $getdata = $database->getReference('agentInfo')->orderByChild("lastName")->getValue();

// $filtered = array_filter($getdata, function (array $userData) {
//     $lastN = $userData['lastName'] ?? '';
//     $firstN = $userData['firstName'] ?? '';
//     $midN = $userData['midName'] ?? '';
//     $agency = $userData['agency'] ?? '';
//     $str = $userData['str'] ?? '';
//     $brgy = $userData['brgy'] ?? '';
//     $city = $userData['city'] ?? '';

//     return stripos($lastN, $_SESSION['filterName']) !== false || stripos($firstN, $_SESSION['filterName']) !== false || stripos($midN, $_SESSION['filterName']) !== false
//     || stripos($agency, $_SESSION['agency']) !== false || stripos($city, $_SESSION['locC']) !== false || stripos($brgy, $_SESSION['locC']) !== false
//     || stripos($str, $_SESSION['locC']) !== false;

// });

// $_SESSION['searchName'] = $filtered;

// header("Location: agents.php");
// exit(0);
// }


?>