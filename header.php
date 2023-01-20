<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>CS3 Thesis</title>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="window.location.href='index.php'">Real Estate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="window.location.href='agents.php'">Agents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Asset Value</a>
                    </li>

                </ul>
            </div>
            <?php if(isset($_SESSION['verified_user_id'])){?>
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php 
                            include ('dbconfig.php');
                            $uid = $_SESSION['verified_user_id'];
                            $user = $auth->getUser($uid); 

                            if ($user->photoUrl != NULL) {
                                ?>
                                    <img src="<?=$user->photoUrl?>" width="30" height="30" class="rounded-circle" />
                                <?php
                            }else {
                                ?>
                                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <?php
                            }
                        ?>
                        <span class="d-none d-sm-inline mx-1">Name</span>
                    </a>
                <ul class="dropdown-menu dropdown-menu-left dropdown-menu-end">
                <?php 
                    if ($_SESSION['enduser'] == "Agent") {
                        ?>
                            <li><a class="dropdown-item" href="#" onclick="window.location.href='editprofile.php'">Profile</a></li>
                        <?php
                    }else if($_SESSION['enduser'] == "User"){
                        ?>
                            <li><a class="dropdown-item" href="#" onclick="window.location.href='editprofileuser.php'">Profile</a></li>
                        <?php
                    }
                ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Log-Out</a></li>
                </ul>
            </li>
            <?php }else{?>
            <button class="btn btn-dark btn-outline-light float-right me-2" onclick="window.location.href='login.php';">Login/Register</button>
            <!-- <button class="btn btn-dark btn-outline-light float-right" onclick="window.location.href='signup.php';">Register</button> -->
            <?php }?>
        </div>
    </nav>

<?php
if(isset($_SESSION['status']))
{
    echo "<p class='alert alert-success'>".$_SESSION['status']."</p>";
    unset($_SESSION['status']);
}
?>