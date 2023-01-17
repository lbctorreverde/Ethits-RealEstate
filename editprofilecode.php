<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include ('dbconfig.php');


//SIGN UP AGENT
if(isset($_POST['btn_saveChangesAgent'])){
    $uid = $_SESSION['verified_user_id'];
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
    $dp = $_FILES["dPhoto"]["name"];
    $passConfirm = $_POST['passConfirm'];


    $getdata = $database->getReference('agentInfo')->getChild($_SESSION['verified_user_id'])->getValue();
    if ($getdata['password'] != $passConfirm) {
        $_SESSION['status'] = "Updating failed due to incorrect password";
        header('Location: editprofile.php');
        exit;
    }else {
        $userProperties = [
            'firstName' => $fname,
            'lastName' => $lname,
            'midName' => $mname,
            'bday' => $bday,
            'sex' => $sex,
            'contactNo' => $contact,
            'agency' => $agency,
            'agencyLoc' => [
                'city' => $city,
                'brgy' => $brgy,
                'str' => $str
            ],
            'email' => $email,
            'password' => $pass,
            'Status' => '',
            "metadata" => [
                "createdAt" => ['.sv' => 'timestamp'],
                "lastLoginAt" => "",
                "passwordUpdatedAt" => "",
                "lastRefreshAt" => ""
            ]
        ];

        $ref_table = "agentInfo/" . $_SESSION['verified_user_id'];
        $updateData = $database->getReference($ref_table)->update($userProperties);

        //Update Email and Password
        $userEPass = [
            'uid' => $_SESSION['verified_user_id'],
            'email' => $email,
            'password' => $pass,
        ];

        $updatedEmail = $auth->changeUserEmail($_SESSION['verified_user_id'], $email);
        $updatedPass = $auth->changeUserPassword($_SESSION['verified_user_id'], $pass);

        //Update and Setting Agent Display Photo
        $random_no = rand(1111, 9999);
        $user = $auth->getUser($_SESSION['verified_user_id']);
        $new_image = $_SESSION['verified_user_id'].$random_no.$dp;
        $old_image = $user->photoUrl;

        if ($dp != NULL) {
            $filename = "uploads/agentInfo/".$uid."/".$new_image;
        }else {
            $filename = $old_image;
        }

        $userDP = [
            'photoUrl' => $filename
        ];
        $uid = $_SESSION['verified_user_id'];
        $updateDP = $auth->updateUser($uid, $userDP);

        if ($updateDP) {
            if ($dp != NULL) {
                move_uploaded_file($_FILES['dPhoto']['tmp_name'], "uploads/agentInfo/".$uid."/".$new_image);
                if ($old_image != NULL) {
                    unlink($old_image);
                }
            }
            $_SESSION['status'] = "Profile Picture Updated Successfully";
            header('Location: editprofile.php');
            exit(0);
        }else {
            $_SESSION['status'] = "Profile Picture Failed to Update";
            header('Location: editprofile.php');
            exit(0);
        }
        
        


        if ($updateData and $updatedEmail and $updatedPass) {
            $_SESSION['status'] = "Profile Updated Successfully";
            header('Location: editprofile.php');
            exit;
        } else {
            $_SESSION['status'] = "Profile Failed to Update";
            header('Location: editprofile.php');
            exit;
        }
    }
    
}elseif (isset($_POST['btn_saveChangesUser'])) {
    $uid = $_SESSION['verified_user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $dp = $_FILES["dPhoto"]["name"];
    $passConfirm = $_POST['passConfirm'];
    $type = "Agent";

    $getdata = $database->getReference('userInfo')->getChild($_SESSION['verified_user_id'])->getValue();
    if ($getdata['password'] != $passConfirm) {
        $_SESSION['status'] = "Updating failed due to incorrect password";
        header('Location: editprofileuser.php');
        exit;
    } else {
        $userProperties = [
            'firstName' => $fname,
            'lastName' => $lname,
            'bday' => $bday,
            'sex' => $sex,
            'contactNo' => $contact,
            'location' => [
                'city' => $city,
                'brgy' => $brgy,
                'str' => $str
            ],
            'email' => $email,
            'password' => $pass,
            'Status' => '',
            "metadata" => [
                "createdAt" => ['.sv' => 'timestamp'],
                "lastLoginAt" => "",
                "passwordUpdatedAt" => "",
                "lastRefreshAt" => ""
            ]
        ];

        $ref_table = "userInfo/" . $_SESSION['verified_user_id'];
        $updateData = $database->getReference($ref_table)->update($userProperties);

        $userEPass = [
            'uid' => $uniqueKey,
            'email' => $email,
            'password' => $pass,
        ];

        //Update Email and Password
        $updatedEmail = $auth->changeUserEmail($_SESSION['verified_user_id'], $email);
        $updatedPass = $auth->changeUserPassword($_SESSION['verified_user_id'], $pass);

        //Update and Setting Agent Display Photo
        $random_no = rand(1111, 9999);
        $user = $auth->getUser($_SESSION['verified_user_id']);
        $new_image = $_SESSION['verified_user_id'].$random_no.$dp;
        $old_image = $user->photoUrl;

        if ($dp != NULL) {
            $filename = 'uploads/userInfo/'.$uid."/".$new_image;
        }else {
            $filename = $old_image;
        }

        $userDP = [
            'photoUrl' => $filename
        ];
        $updateDP = $auth->updateUser($uid, $userDP);

        if ($updateDP) {
            if ($dp != NULL) {
                move_uploaded_file($_FILES['dPhoto']['tmp_name'], "uploads/userInfo/".$uid."/".$new_image);
                if ($old_image != NULL) {
                    unlink($old_image);
                }
            }
            $_SESSION['status'] = "Profile Picture Updated Successfully";
            header('Location: editprofile.php');
            exit(0);
        }else {
            $_SESSION['status'] = "Profile Picture Failed to Update";
            header('Location: editprofile.php');
            exit(0);
        }
        

        if ($updateData and $updatedEmail and $updatedPass) {
            $_SESSION['status'] = "Profile Updated Successfully";
            header('Location: editprofile.php');
            exit;
        } else {
            $_SESSION['status'] = "Profile Failed to Update";
            header('Location: editprofile.php');
            exit;
        }
    }
}

?>

