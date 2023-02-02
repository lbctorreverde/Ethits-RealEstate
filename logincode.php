<?php
session_start();
include ('dbconfig.php');
//LOGIN AGENT
if(isset($_POST['btn_loginAgent'])){
   
    $email = $_POST["email"];
    $password = $_POST["password"];

    // check if credentials are okay, and email is verified
    $sql = "SELECT * FROM tbl_agent WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 0)
    {
        $_SESSION['status'] = "Email not found";
        header('Location: login.php');
        exit();
    }

    if (!password_verify($password, $rows['password']))
    {
        $_SESSION['status'] = "Password is not correct";
        header('Location: login.php');
        exit();
    }

    if ($rows['email_verified_at'] == null)
    {
        die("Please verify your email <a href='email-verification.php?email=".$email."'>from here</a>");
    }

    $_SESSION['verified_user_id'] = $email;
    $_SESSION['user_ID'] = $rows['agent_ID'];
    $_SESSION['enduser'] = 'Agent';
    $_SESSION['status'] = "Login Successfully";
    header('Location: index.php');
    exit(); 
}

//LOGIN USER
if(isset($_POST['btn_loginUser'])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    // check if credentials are okay, and email is verified
    $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 0)
    {
        $_SESSION['status'] = "Email not found";
        header('Location: login.php');
        exit();
    }

    $user = mysqli_fetch_object($result);

    if (!password_verify($password, $row['password']))
    {
        $_SESSION['status'] = "Password is not correct";
        header('Location: login.php');
        exit();
    }

    if ($row['email_verified_at'] == null)
    {
        die("Please verify your email <a href='email-verificationUser.php?email=".$email."'>from here</a>");
    }

    $_SESSION['verified_user_id'] = $email;
    $_SESSION['user_ID'] = $row['user_ID'];
    $_SESSION['enduser'] = 'User';
    $_SESSION['status'] = "Login Successfully";
    header('Location: login.php');
    exit(); 
}

?>

