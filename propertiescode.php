<?php

session_start();
include ('dbconfig.php');
$a = array();
if(isset($_POST["btn_search"])){
    $searchN = $_POST['searchProp'];
    $filter = $_POST['filter'];
    $_SESSION['searchProp'] = $searchN;

// $getdata = $database->getReference('agentInfo')->orderByChild('firstName')->startAt('Jay')->getValue();
$getdata = $database->getReference('propertyInfo')->startAt($searchN)->getValue();

$loop1 = $database->getReference('propertyInfo')->getChildKeys();
    foreach ($loop1 as $x => $y) {
        $loop = $database->getReference('propertyInfo/'.$y)->getValue();
        if (isset($loop)) {
            $a = array($a, $loop);
        }
    }

    foreach ($loop as $key => $row) {
        $filtered = array_filter($row, function (array $userData) {
            $filter = $_POST['filter'];
            $searchN = $_POST['searchProp'];
            $title = $userData['title'] ?? '';
            $bath = $userData['bath'] ?? '';
            $bed = $userData['bed'] ?? '';
            $sf = $userData['sf'] ?? '';
            $location = $userData['location'] ?? '';

            if ($filter == 'Title') {
                return stripos($title, $searchN) !== false;
            } elseif ($filter == 'Bath') {
                return stripos($bath, $searchN) !== false;
            } elseif ($filter == 'Bed') {
                return stripos($bed, $searchN) !== false;
            } elseif ($filter == 'Sf') {
                return stripos($sf, $searchN) !== false;
            } elseif ($filter == 'Loc') {
                return stripos($location, $searchN) !== false;
            }
        });
    }
$_SESSION['searchProp'] = $filtered;

$database->getReference('agentInfo')->orderByChild("lastName")->getValue();
header("Location: properties.php");
exit(0);

}

?>