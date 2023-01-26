<?php
include_once 'header.php';

include('dbconfig.php');
?>

<style>
    <?php include 'css/agents.css'; ?>
</style>


<section class="topsection d-flex flex-column text-center justify-content-center align-items-center">
    <h1 class="display-5">Find your agent on this page</h1>
</section>

<form action="agentscode.php" method="POST" role="search" id="form">
    <input type="search" id="query" name="searchName" placeholder="Search..." aria-label="Search through site content">
    <?php
    $_SESSION['agentselected'] = "";
    if ($_SESSION['searchName'] == "") {
        $_SESSION['searchName'] = $database->getReference('agentInfo')->orderByChild("lastName")->getValue();
    }
    ?>
    <select class="form-select" name="filter" id="filter" required>
        <option value="Name">Name</option>
        <option value="Agency">Agency</option>
        <option value="Location">Location</option>
    </select>
    <span class="vr me-3"></span>
    <button type="submit" name="btn_search" class="searchbtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg></button>
</form>

<section class="secondsection d-flex flex-row">
    <div class="left-panel">
        <h4 class="fw-normal">Bataan Agents</h4>
        <?php
        $x = 0;
        foreach ($_SESSION['searchName'] as $key => $value) {
            $x++;
        }
        ?>
        <p><b><?php echo $x ?></b> Results</p>
    </div>
    <div class="agentslist-panel">

        <?php
        foreach ($_SESSION['searchName'] as $key => $row) {
        ?>
            <!-- CARD FOR EACH AGENT PAR-->
            <div class="agentcard row g-0 mt-2 shadow">
                <div class="col-md-2">
                    <?php
                    $user = $auth->getUser($row['Uniquekey']);
                    if ($user->photoUrl != NULL) {
                    ?>
                        <img src="<?= $user->photoUrl ?>" class="img-fluid rounded-start" alt="..." width="150" height="150" />
                    <?php
                    } else {
                    ?>
                        <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid rounded-start" alt="..." width="150" height="150" />
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <?php
                        $getK = $database->getReference('agentInfo')->getChild($row['Uniquekey'])->getKey(); ?>
                        <!-- Paiba nalang, sa notfound.php pa redirect nya eh -->
                        <form method="POST" action="agentC.php" class="agent-name-post d-flex form-control text-start">
                            <input type="hidden" id="hide" name="hide" value="<?php echo $row['Uniquekey'] ?>">
                            <button class="agent-name-button" type="submit" id="btn_hide" name="btn_hide"><?php echo $row['lastName'] . ", " . $row['firstName'] . " " . substr($row['midName'], 0, 1) . "." ?></button>
                        </form>

                        <!-- <input type="hidden" id="hide" name="hide" value="<?php echo $row['Uniquekey'] ?>">
                        <a onclick="window.location.href='agentC.php'" type="submit" id="btn_hide" name="btn_hide"><?php echo $row['lastName'] . ", " . $row['firstName'] . " " . substr($row['midName'], 0, 1) . "." ?></a> -->

                        <a onclick="<?php $_SESSION['agentselected'] = $row['Uniquekey'] ?>" href="agentportfolio.php" class="btn btn-dark" style="text-decoration: none;"></a>
                        <a class="text-decoration-none text-reset" onclick="window.location.href='agentportfolio.php';"></a>
                        <p class="card-text text-muted">Real Estate Professional<br>
                            <?php echo $row['agency'] . " - " . $row['str'] . ", " . $row['brgy'] . ", " . $row['city'] . ", Bataan" ?>
                        </p>
                        <p class="card-title text-muted">Contact: </p>
                        <p class="card-text"><small class="text-muted lh-sm"><?php echo $row['contactNo'] ?></small></p>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
</section>

<script type="text/javascript">
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
</script>

<?php
$_SESSION['searchName'] = "";
$_SESSION['agency'] = "";
$_SESSION['locC'] = "";
?>