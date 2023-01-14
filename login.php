<?php include_once 'navbarfresh.php'; ?>

<style>
    <?php include 'css/login.css'; ?>
</style>

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="#">
            <h1>Sign is as User</h1>
            <input type="text" placeholder="Name" />
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <button>Log in</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="#">
            <h1>Sign in as Agent</h1>
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <a class="forgot-link" href="#">Forgot your password?</a>
            <button>Log in</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Are you an Agent?</h1>
                <p>Log in as an agent now to connect with clients!</p>
                <button class="ghost" id="signIn">Log in as an agent</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Are you a user?</h1>
                <p>Log in as a user now to find the agent of your needs!</p>
                <button class="ghost" id="signUp">Log in as a User</button>
            </div>
        </div>
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
