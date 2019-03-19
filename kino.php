<?php
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIEJE prihlaseny
    header('Location: /');
    exit;
}
$pageTitle = 'Kino';
include 'src/templates/db-config.php';
include 'src/templates/header.php';
include 'src/templates/header-close.php';

$selectAllMoviesQuery = 'SELECT * FROM movies;';
$moviesResult = mysqli_query($db, $selectAllMoviesQuery);
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
            <?php
            if (!is_bool($moviesResult)) {
                /* Check if there is at least one result */
                if (mysqli_num_rows($moviesResult) > 0) {
                    /* Iterate over every movie */
                    while ($row = mysqli_fetch_assoc($moviesResult)) {
                        ?>
                        <div class="movie-row">
                            <div class="col s12 m7">
                                <div class="card horizontal">
                                    <div class="card-image">
                                        <img src="/src/img/moviesimg/<?php echo $row['imageLink'] ?>">
                                    </div>
                                    <div class="card-stacked">
                                        <div class="card-content">
                                            <h4><?php echo $row['title'] ?></h4>
                                            <p><?php echo $row['description'] ?></p>
                                        </div>
                                        <div class="card-action">
                                            <a href="/reservation.php?movieID=<?php echo $row['movieID'] ?>">Order</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
include 'src/templates/footer.php';
?>
