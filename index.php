<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    // Pouzivatel uz ma cookienu
    if ($_SESSION['loggedin'] == true) {
        // Pouzivatel je prihlaseny
        header('Location: /kino.php');
        exit;
    }
}
include 'src/templates/db-config.php';
$pageTitle = 'Login';
include 'src/templates/header.php';
include 'src/templates/header-close.php';
?>
<link rel="stylesheet" href="/src/css/material.min.css">

<div class="login-wrapper">
    <div class="login-card-wrapper">
        <div class="login-card-menu">
            <a class="mdl-button mdl-js-button">
                Prihlásenie
            </a>
            <a class="mdl-button mdl-js-button" href="register.php">
                Register
            </a>
        </div>

        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
            <form action="src/db-queries/login-user.php"
                  onsubmit="return validateRegisterForm(this)"
                  method="post">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="name" type="text" id="formName">
                    <label class="mdl-textfield__label" for="formName">Username</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="password" type="password" id="formPassword">
                    <label class="mdl-textfield__label" for="formPassword">Password</label>
                </div>
                <div class="error-message-username">Username or password are incorrect</div>
                <button class="mdl-button mdl-js-button mdl-button--raised">
                    LOGIN
                </button>
            </form>
        </div>
    </div>
</div>


<?php
include 'src/templates/footer.php';
?>

<script type="text/javascript">
    const errorMessageUsername = document.querySelector('.error-message-username');
    let url = window.location.href;
    url = new URL(url);
    const param = url.searchParams.get('wrongUsernameOrPassword');

    if (param === '1') {
        errorMessageUsername.style.display = 'block';
    }

    function validateRegisterForm(form) {
        errorMessageUsername.style.display = 'none';
        const username = form.name.value;
        const password = form.password.value;
        let redirect = true;

        // Check if username is empty
        if (username.length <= 0) {
            redirect = false;
        }

        // Check if password is empty
        if (password.length <= 0) {
            redirect = false;
        }

        return redirect;
    }
</script>
