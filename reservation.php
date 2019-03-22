<?php
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIEJE prihlaseny
    header('Location: /');
    exit;
}
if (!isset($_GET['movieID'])) {
    // Neprisiel GET s movieID
    header('Location: /kino.php');
    exit;
}
$pageTitle = 'Rezervácia';
include 'src/templates/db-config.php';
include 'src/templates/header.php';
include 'src/templates/header-close.php';

$movieID = $_GET['movieID'];

$selectMovie = "SELECT * FROM movies WHERE movieID=" . $movieID . ";";
$selectSeats = "SELECT * FROM seats WHERE seatMovieID=" . $movieID . ";";
$moviesQueryResult = mysqli_query($db, $selectMovie);
$seatQueryResult = mysqli_query($db, $selectSeats);

$movieResult = mysqli_fetch_assoc($moviesQueryResult);
$seatResult = mysqli_fetch_assoc($seatQueryResult);

$seatTemplateId = 1;
?>

<div class="kino-wrapper">
    <?php include 'src/templates/navbar.php'; ?>

    <div class="movies-wrapper">
        <div class="container">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content center">
                        <h1>----RESERVATION ON MOVIE----</h1>
                        <h2><?php echo $movieResult['title'] ?></h2>
                        <p><?php echo $movieResult['description'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content center">
                        <!--Success on ordering-->
                        <!--TODO: create some popup text that order was successful-->
                        <!--Platno-->
                        <div class="row">
                            <h4 class="success-message">Seats were successfully reserved</h4>
                        </div>
                        <div class="row platno-wrapper">
                            <div id="platno">
                                THIS WAY IS SCREEN
                            </div>
                        </div>
                        <!--Seats-->
                        <div class="row">
                            <form action="/src/db-queries/insert-seat.php"
                                  method="post">
                                <input type="hidden" name="seatMovieID" value="<?php echo $movieID ?>">
                                <?php for ($i = 1; $i <= 4; $i++) { ?>
                                    <div class="seat-row"><span class="row-id">ROW <?php echo $i ?>:</span>
                                        <?php for ($k = 1; $k <= 5; $k++) { ?>
                                            <label>
                                                <input <?php if ($seatResult['seat' . $seatTemplateId] == 1) { ?>
                                                        disabled="disabled"
                                                        <?php } ?>type="checkbox"
                                                        name="seat<?php echo $seatTemplateId ?>"/>
                                                <span class="seat-number"><?php echo $seatTemplateId ?></span>
                                            </label>
                                            <?php $seatTemplateId++ ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="row center">
                                    <button style="margin-top: 20px;" class="waves-effect wave-light btn btn-submit"
                                            type="submit">Order seats
                                    </button>
                                </div>
                            </form>

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

<script type="text/javascript">
    const successMessage = document.querySelector('.success-message');
    let url = window.location.href;
    url = new URL(url);
    const param = parseInt(url.searchParams.get('success'));
    if (param === 1) {
        successMessage.style.display = 'block';
    }
</script>