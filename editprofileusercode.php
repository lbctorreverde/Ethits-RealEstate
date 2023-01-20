<?php
use Firebase\Auth\Token\Exception\InvalidToken;
session_start();
include ('dbconfig.php');


if (isset($_POST['btn_saveChangesUser'])) {
    $uid = $_SESSION['verified_user_id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $brgy = $_POST['brgy'];
    $city = $_POST['city'];
    $str = $_POST['str'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $dp = $_FILES["dPhoto"]["name"];
    $passConfirm = $_POST['passConfirm'];
    
    $getdata = $database->getReference('userInfo/')->getChild($uid)->getValue();
    if ($getdata['password'] != $passConfirm) {
        $_SESSION['status'] = "Updating failed due to incorrect password";
        header('Location: editprofileuser.php');
        exit(0);
    } else {
        $userProperties = [
            'firstName' => $fname,
            'lastName' => $lname,
            'bday' => $bday,
            'sex' => $sex,
            'contactNo' => $contact,
            'city' => $city,
            'brgy' => $brgy,
            'str' => $str,
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

        $ref_table = "userInfo/" .$_SESSION['verified_user_id'];
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
            if (!file_exists("uploads/userInfo/".$uid."/".$new_image)) {
                mkdir("uploads/userInfo/".$uid."/", 0777, true);
            }else {
                $filename = "uploads/userInfo/".$uid."/".$new_image;
            }
            $filename = "uploads/userInfo/".$uid."/".$new_image;
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
            header('Location: editprofileuser.php');
            exit(0);
        }else {
            $_SESSION['status'] = "Profile Picture Failed to Update";
            header('Location: editprofileuser.php');
            exit(0);
        }
        

        if ($updateData and $updatedEmail and $updatedPass) {
            $_SESSION['status'] = "Profile Updated Successfully";
            header('Location: editprofileuser.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Profile Failed to Update";
            header('Location: editprofileuser.php');
            exit(0);
        }
    }
}

?>
