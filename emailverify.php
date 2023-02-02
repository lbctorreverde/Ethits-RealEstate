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

    <div class="input-group">
        <input type="text" maxlength="6" class="field form-control" id="floatingInput" placeholder="Code (XXXXXX)" aria-label="Code (XXXXXX)" aria-describedby="basic-addon2">
        <span class="input-group-text">
            <button type="button" class="btn btn-outline-light">Verify</button>
        </span>
    </div>
</div>

<div class="footer">
    <?php include_once 'footer.php' ?>
</div>