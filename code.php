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

    $user = ('some-uid');

    $userProperties = [

        'firstName' => $fname,
        'lastName' => $lname,
        'midName' => $mname,
        'bday' => $bday,
        'sex' => $sex,
        'contactNo' => $contact,
        'agency' => $agency,
        'agencyLoc' =>[
            'city' => $city,
            'brgy' => $brgy,
            'str' => $str
        ],
        'email' => $email,
        'password' => $pass,
        'Status' => ''
        
    ];

    
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

