<?php
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIEJE prihlaseny
    header('Location: /');
    exit;
}
$pageTitle = 'About';
include 'src/templates/header.php';
include 'src/templates/header-close.php';
?>

<div class="kino-wrapper">
    <?php include 'src/templates/navbar.php'; ?>

    <div class="movies-wrapper">
        <div class="container">
            <div class="movie-row">
                <div class="col s12 m7">
                    <div class="card">
                        <div class="card-content">
                            <h3 class="center">Kino</h3>
                            <h6>This project was created for a long-term project for subject called TIU by Matej
                                Strnisko.</h6>
                            <h6>This build is versatible, meaning, it can be put on any device and the necessary tables for database will be automatically generated.</h6>
                            <h6>Project consists of following technologies/libraries:</h6>
                            <ol>
                                <li>PHP</li>
                                <li>JavaScript</li>
                                <li>SQL / MYSQL</li>
                                <li>SASS</li>
                                <li>materialize.css</li>
                            </ol>
                            <h6>Creating the site took 7-8 hours.</h6>
                            <h6>Fresh deployment setup on linux took 12-14 hours.</h6>
                            <h6><a href="https://github.com/Matrez/TIU" target="_blank">Github Page</a></h6>
                            <p class="center">Matej Strnisko, 4.A - 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'src/templates/footer.php';
?>
