<?php
session_start();
include ('dbconfig.php');

if (isset($_SESSION['status'])) {
    echo "<p class='alert alert-success'>" . $_SESSION['status'] . "</p>";
    unset($_SESSION['status']);
}

if (isset($_POST["verify_email"]))
{
    $email = $_POST["email"];
    $token = $_POST["token"];

    // mark email as verified
    $sql = "UPDATE tbl_user SET email_verified_at = NOW() WHERE email = '$email' AND token = '$token'";
    mysqli_query($connect, $sql);

    if (mysqli_affected_rows($connect) == 0)
    {
        $_SESSION['status'] = "Verification Failed";
        header("Location: email-verificationUser.php?email=" . $email);
        exit(); 
    }

    $_SESSION['status'] = "Agent successfully registered and verified";
    header('Location: login.php');
    exit(); 
}

?>

<form method="POST">
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
    <input type="text" name="token" placeholder="Enter verification code" required />
    <input type="submit" name="verify_email" value="Verify Email">
</form>