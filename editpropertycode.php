<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include ('dbconfig.php');
function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//SIGN UP AGENT
if(isset($_POST['btn_saveChangesAgent'])){
    $uid = $_SESSION['verified_user_id'];
    $title = $_POST['title'];
    $stats = $_POST['stats'];
    $bed = $_POST['bed'];
    $basement = $_POST['basement'];
    $garage = $_POST['garage'];
    $location = $_POST['location'];
    $lot = $_POST['lot'];
    $sf = $_POST['sf'];
    $bath = $_POST['bath'];
    $dp = $_FILES['propertyImg']['tmp_name'];
    

    $userProperties = [
        'title' => $title,
        'stats' => $stats,
        'bed' => $bed,
        'basement' => $basement,
        'garage' => $garage,
        'location' => $location,
        'lot' => $lot,
        'sf' => $sf,
        'bath' => $bath,
        'propertyImg' => '',
        "metadata" => [
            "createdAt" => ['.sv' => 'timestamp'],
            "lastLoginAt" => "",
            "passwordUpdatedAt" => "",
            "lastRefreshAt" => ""
        ]
    ];

    if ($stats == "Active") {
        $ref_table = "propertyInfo/".$_SESSION['verified_user_id'];
        $check = $database->getReference($ref_table)->push($userProperties)->getKey();
        

        $object = $bucket->upload(
            file_get_contents($_FILES['propertyImg']['tmp_name']),
            [
                'name' => 'propertyInfo/'.$uid.'/'.$check.'/'.$_FILES['propertyImg']['name']
            ]
        );

        $url = $object->signedUrl(new \DateTime('31 days'));

        $properties = [
            'propertyImg' =>  $url
        ];
        
        $ck = $database->getReference($ref_table.'/'.$check)->update($properties);

        if(isset($ck)){
            $_SESSION['status'] = "Portfolio Updated Successfully";
            header('Location: editproperty.php');
            exit;
        }  
    }elseif($stats == "Sold"){
        $ref_table = "soldProperty/".$_SESSION['verified_user_id'];
        $check = $database->getReference($ref_table)->push($userProperties)->getKey();
        

        $object = $bucket->upload(
            file_get_contents($_FILES['propertyImg']['tmp_name']),
            [
                'name' => 'soldProperty/'.$uid.'/'.$check.'/'.$_FILES['propertyImg']['name']
            ]
        );

        $url = $object->signedUrl(new \DateTime('31 days'));

        $properties = [
            'propertyImg' =>  $url
        ];
        
        $ck = $database->getReference($ref_table.'/'.$check)->update($properties);

        if(isset($ck)){
            $_SESSION['status'] = "Portfolio Updated Successfully";
            header('Location: editproperty.php');
            exit;
        }  
    }
      
}
?>


