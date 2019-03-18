<?php
include 'src/templates/db-config.php';
$pageTitle = 'Registration';
include 'src/templates/header.php';
include 'src/templates/header-close.php';
?>
<link rel="stylesheet" href="/src/css/material.min.css">
<div class="login-wrapper">
    <div class="login-card-wrapper">
        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
            <div class="registration-success">
                <p style="margin-bottom: 5px;">Thank you for your registration, you will be redirected shortly.</p>
                <p>If you're not redirected withing 5 seconds, press the redirect button.</p>
            </div>
            <a class="mdl-button mdl-js-button mdl-button--raised" href="/">
                REDIRECT
            </a>
        </div>
    </div>
</div>


<?php
include 'src/templates/footer.php';
?>

<script type="text/javascript">
    setTimeout(() => {
        document.location.href = '/';
    }, 2500)
</script>
