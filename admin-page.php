<?php
session_start();
if ($_SESSION['admin'] != true) {
    // Pouzivatel NIEJE admin
    header('Location: /');
}
$pageTitle = 'Admin page';
include 'src/templates/header.php';
include 'src/templates/header-close.php';
?>

<div class="kino-wrapper">
    <nav>
        <div class="nav-wrapper">
            <a href="/kino.php" class="brand-logo hide-on-med-and-down">Kino</a>
            <span class="logged-in-username">You're logged in as: <b><?php echo $_SESSION['username'] ?></b></span>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">My reservations</a></li>
                <li><a href="#">About</a></li>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <li><a href="/admin-page.php">Admin page</a></li>
                <?php } ?>
                <li><a href="/src/templates/nav.php?logOut=1">Log Out</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="#">Kino</a></li>
        <li><a href="#">My reservations</a></li>
        <li><a href="#">About</a></li>
        <?php if (isset($_SESSION['admin'])) { ?>
            <li><a href="/admin-page.php">Admin page</a></li>
        <?php } ?>
        <li><a href="/src/templates/nav.php?logOut=1">Log Out</a></li>
    </ul>

    <div class="movies-wrapper">
        <div class="container">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content center">
                        <h1>ADMIN PAGE</h1>
                    </div>
                </div>
            </div>
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <form enctype="multipart/form-data"
                              class="col s12"
                              action="/src/db-queries/input-movie.php"
                              method="post"
                              onsubmit="return validateForm(this)">
                            <div class="row center">
                                <?php if (isset($_GET['succes'])) { ?>
                                <h4 class="movie-success">Successfully added a new movie!</h4>
                                <h4>Do you want to add another movie?</h4>
                                <?php } else { ?>
                                <h4>Adding a new movie</h4>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="movie-title" type="text" name="title">
                                    <label for="movie-title">Full Title of movie</label>
                                </div>
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" name="desc"></textarea>
                                    <label for="textarea1">Description of movie</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row center">
                                <button class="waves-effect wave-light btn btn-submit" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'src/templates/footer.php';
?>

<script type="text/javascript">
    function validateForm(form) {
        return true;
    }
</script>