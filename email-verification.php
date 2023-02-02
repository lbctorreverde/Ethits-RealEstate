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
    $sql = "UPDATE tbl_agent SET email_verified_at = NOW() WHERE email = '$email' AND token = '$token'";
    mysqli_query($connect, $sql);

    if (mysqli_affected_rows($connect) == 0)
    {
        $_SESSION['status'] = "Verification Failed";
        header("Location: email-verification.php?email=" . $email);
        exit(); 
    }

    $_SESSION['status'] = "User successfully registered and verified";
    header('Location: login.php');
    exit(); 
}

?>

<?php include_once 'navbarfresh.php' ?>

<style>
    <?php include 'css/emailverify.css' ?>
</style>

<div class="container d-flex flex-column align-items-center justify-content-center">
    <div class="text-center mb-4">
        <span class="display-6 px-2">
            Please enter the verification code that we have sent to you via email
        </span>
    </div>
    <form method="POST">
    <div class="input-group">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
        <input type="text" class="field form-control" name="token" maxlength="6" id="floatingInput" placeholder="Enter verification code" required />
        <span class="input-group-text">
            <input type="submit" name="verify_email" value="Verify Email">
        </span>
    </div>
    </form>

</div>

<div class="footer">
    <?php include_once 'footer.php' ?>
</div>


    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
    <input type="text" name="token" placeholder="Enter verification code" required />
    <input type="submit" name="verify_email" value="Verify Email">