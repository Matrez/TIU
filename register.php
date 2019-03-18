<?php
session_start();
if ($_SESSION['loggedin'] == true) {
    header('Location: /kino.php');
    exit;
}
$pageTitle = 'Register';
include 'src/templates/header.php';
include 'src/templates/header-close.php';
?>
<link rel="stylesheet" href="/src/css/material.min.css">
<div class="login-wrapper">
    <div class="login-card-wrapper">
        <div class="login-card-menu">
            <a class="mdl-button mdl-js-button" href="/">
                Login
            </a>
            <a class="mdl-button mdl-js-button">
                Register
            </a>
        </div>

        <div class="demo-card-wide mdl-card mdl-shadow--2dp register-demo-card">
            <!-------FORM DATA------->
            <!--name-->
            <!--password-->
            <!--passwordAgain-->
            <!-------END OF FORM DATA------->
            <form action="src/db-queries/register-user.php"
                  onsubmit="return validateRegisterForm(this);"
                  method="post">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="name" type="text" id="formName">
                    <label class="mdl-textfield__label" for="formName">Username</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="password" type="password" id="formPassword">
                    <label class="mdl-textfield__label" for="formPassword">Password</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="passwordAgain" type="password" id="formPasswordAgain">
                    <label class="mdl-textfield__label" for="formPasswordAgain">Password again</label>
                </div>
                <div class="error-message-username-exists">Username already exists</div>
                <div class="error-message-username">Username must be without spaces in alphabet or numbers</div>
                <div class="error-message-password-minimum">Password must have minimum of 6 characters</div>
                <div class="error-message-password-match">Passwords must match</div>
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
                    REGISTER
                </button>
            </form>
        </div>
    </div>
</div>

<?php
include 'src/templates/footer.php';
?>

<script type="text/javascript">

    const errorMessageUsernameExists = document.querySelector('.error-message-username-exists');
    let url = window.location.href;
    url = new URL(url);
    const param = url.searchParams.get('usernameExists');

    if (param === '1') {
        errorMessageUsernameExists.style.display = 'block';
    }

    function validateRegisterForm(form) {
        errorMessageUsernameExists.style.display = 'none';

        let username = form.name.value;
        let password = form.password.value;
        let passwordAgain = form.passwordAgain.value;
        const errorMessagePasswordMatch = document.querySelector('.error-message-password-match');
        const errorMessagePasswordMinimum = document.querySelector('.error-message-password-minimum');
        const errorMessageUsername = document.querySelector('.error-message-username');
        let dontReload = false;

        // Check if username doesn't contain letters and  have white spaces
        if (!username.match('[a-zA-Z0-9]') || username.includes(' ')) {
            errorMessageUsername.style.display = 'block';
            dontReload = true;
        } else {
            errorMessageUsername.style.display = 'none';
        }

        // Check if passwords don't match
        if (password !== passwordAgain) {
            errorMessagePasswordMatch.style.display = 'block';
            dontReload = true;
        } else {
            errorMessagePasswordMatch.style.display = 'none';
        }

        // Check if password is shorter than 6
        if (password.length < 6) {
            errorMessagePasswordMinimum.style.display = 'block';
            dontReload = true;
        } else {
            errorMessagePasswordMinimum.style.display = 'none';
        }

        return !dontReload;
    }
</script>
