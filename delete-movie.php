<?php
session_start();
if ($_SESSION['admin'] != true) {
    // Pouzivatel NIEJE admin
    header('Location: /');
    exit;
}
include 'src/templates/db-config.php';

$movieID = $_GET['movieID'];

$deleteOrderQuery = "DELETE FROM orders WHERE movieID={$movieID};";
echo $deleteOrderQuery;
mysqli_query($db, $deleteOrderQuery);

$deleteMovieQuery = "DELETE FROM movies WHERE movieID={$movieID};";
echo $deleteMovieQuery;
mysqli_query($db, $deleteMovieQuery);

$deleteSeatsQuery = "DELETE FROM seats WHERE seatMovieID={$movieID};";
echo $deleteSeatsQuery;
mysqli_query($db, $deleteSeatsQuery);

header('Location: /kino.php');
exit;