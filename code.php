<?php
session_start();
include ('dbconfig.php');


//SIGN UP AGENT
if(isset($_POST['btn_registerAgent'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $agency = $_POST['agency'];
    $brgy = $_POST['brgy'];
    $city = $_POST['city'];
    $str = $_POST['str'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $type = "Agent";

    $userProperties = [
        'firstName' => $fname,
        'lastName' => $lname,
        'midName' => $mname,
        'bday' => $bday,
        'sex' => $sex,
        'contactNo' => $contact,
        'agency' => $agency,
        'city' => $city,
        'brgy' => $brgy,
        'str' => $str,
        'email' => $email,
        'password' => $pass,
        'Status' => '',
        'Uniquekey' => ''
        
    ];

    $ref_table = "agentInfo/";
    $uniqueKey = $database->getReference($ref_table)->push($userProperties)->getKey();

    $userEPass = [
        'uid' => $uniqueKey,
        'email' => $email,
        'password' => $pass
    ];
    
    $createdUser = $auth->createUser($userEPass);

    $userKey = [
        'Uniquekey' => $uniqueKey
    ];

    $database->getReference("agentInfo/".$uniqueKey)->update($userKey);

    if($createdUser){
        $_SESSION['status'] = "User Created/Registered Successfully";
        header('Location: login.php');
        exit;
    }else{
        $_SESSION['status'] = "User Not Created/Registered";
        header('Location: login.php');
        exit;
    }
    
}elseif (isset($_POST['btn_registerUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $type = "Agent";

    $userProperties = [
        'firstName' => $fname,
        'lastName' => $lname,
        'midName' => '',
        'bday' => '01/01/1900',
        'sex' => '',
        'contactNo' => '',
        'city' => '',
        'brgy' => '',
        'str' => '',
        'email' => $email,
        'password' => $pass,
        'Status' => '',
        'Uniquekey' => '',
        "metadata" => [
            "createdAt" => ['.sv' => 'timestamp'],
            "lastLoginAt" => "",
            "passwordUpdatedAt" => "",
            "lastRefreshAt" => ""
        ]
    ];

    $ref_table = "userInfo/";
    $uniqueKey = $database->getReference($ref_table)->push($userProperties)->getKey();

    $userEPass = [
        'uid' => $uniqueKey,
        'email' => $email,
        'password' => $pass
    ];
    
    $createdUser = $auth->createUser($userEPass);

    $userKey = [
        'Uniquekey' => $uniqueKey
    ];

    $database->getReference("userInfo/".$uniqueKey)->update($userKey);

    if($createdUser){
        $_SESSION['status'] = "AccountCreated/Registered Successfully";
        header('Location: login.php');
        exit;
    }else{
        $_SESSION['status'] = "Account Not Created/Registered";
        header('Location: login.php');
        exit;
    }
}

?>

