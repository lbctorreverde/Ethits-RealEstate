<?php
session_start();
include('dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <title>CS3 Thesis</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-expand bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="window.location.href='index.php'">Real Estate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="window.location.href='agents.php'">Agents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="window.location.href='properties.php'">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="window.location.href='assetvalue.php'">Asset Value</a>
                    </li>

                </ul>
            </div>
            <?php if (isset($_SESSION['verified_user_id'])) { ?>
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php 
                        if ($_SESSION['enduser'] == 'Agent') { ?>
                                <a class="dealsbtn pt-1 pe-3 text-decoration-none" onclick="window.location.href='propertyall.php'" style='color:white;' href="#"><i class="bi bi-houses-fill"></i> Deals</a>
                           <?php
                        }else { ?>
                                <a class="dealsbtn pt-1 pe-3 text-decoration-none" onclick="window.location.href='propertyalluser.php'" style='color:white;' href="#"><i class="bi bi-houses-fill"></i> Deals</a>
                            <?php
                        }
                    ?>
                    <style>
                        .dealsbtn:hover {
                            transition-duration: 0.2s;
                            opacity: 90%;
                        }
                    </style>
                    <li class="nav-item dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            if ($_SESSION['enduser'] == "Agent") {
                            ?>
                                <?php
                                if (isset($_SESSION['verified_user_id'])) {
                                    $current = $_SESSION['verified_user_id'];
                                    $query = "SELECT *  from tbl_agent WHERE email = '$current'";
                                    $result = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    $user = mysqli_fetch_object($result);
                                }

                                if ($row["displayImg"]) {
                                ?>
                                    <?php echo is_null($row["displayImg"]) ? "-Empty-" : '<img  src="data:image/jpeg;base64,' . base64_encode($row['displayImg']) . '" width="30" height="30" class="rounded-circle">'; ?>
                                <?php
                                } else {
                                ?>
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <?php
                                }
                                ?>
                                <span class="d-none d-sm-inline mx-1"><?php echo $row["fName"] ?></span>
                            <?php
                            } else if ($_SESSION['enduser'] == "User") {
                            ?>
                                <?php
                                if (isset($_SESSION['verified_user_id'])) {
                                    $current = $_SESSION['verified_user_id'];
                                    $query = "SELECT *  from tbl_user WHERE email = '$current'";
                                    $result = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    $user = mysqli_fetch_object($result);
                                }

                                if ($row["displayImg"]) {
                                ?>
                                    <?php echo is_null($row["displayImg"]) ? "-Empty-" : '<img  src="data:image/jpeg;base64,' . base64_encode($row['displayImg']) . '" width="30" height="30" class="rounded-circle">'; ?>
                                <?php
                                } else {
                                ?>
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <?php
                                }
                                ?>
                                <span class="d-none d-sm-inline mx-1"><?php echo $row["fName"] ?></span>
                            <?php
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left dropdown-menu-end">
                            <?php
                            if ($_SESSION['enduser'] == "Agent") {
                            ?>
                                <li><a class="dropdown-item" href="#" onclick="window.location.href='editprofile.php'">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#" onclick="window.location.href='propertyall.php'">Properties</a></li>
                            <?php
                            } else if ($_SESSION['enduser'] == "User") {
                            ?>
                                <li><a class="dropdown-item" href="#" onclick="window.location.href='editprofileuser.php'">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#" onclick="window.location.href='propertyalluser.php'">Properties</a></li>
                            <?php
                            }
                            ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Log-Out</a></li>
                        </ul>
                        
                    </li>
                <?php } else { ?>
                    <button class="btn btn-dark btn-outline-light float-right me-2" onclick="window.location.href='login.php';">Login/Register</button>
                    <!-- <button class="btn btn-dark btn-outline-light float-right" onclick="window.location.href='signup.php';">Register</button> -->
                <?php } ?>
        </div>
    </nav>

    <?php
    if (isset($_SESSION['status'])) {
        echo "<p class='alert alert-success'>" . $_SESSION['status'] . "</p>";
        unset($_SESSION['status']);
    }
    ?>