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
    <?php include 'src/templates/navbar.php'; ?>

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
                                            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                                            <a class="delete-movie right" href="/delete-movie.php?movieID=<?php echo $row['movieID'] ?>">DELETE MOVIE</a>
                                            <?php } ?>
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
