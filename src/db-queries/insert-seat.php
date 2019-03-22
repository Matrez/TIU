<?php
include '../templates/db-config.php';
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIE JE prihlaseny
    header('Location: /');
    exit;
} else {

    $userID = $_SESSION['memberid'];
    $seatMovieID = $_POST['seatMovieID'];
    $stringOfSeats = '';

    $counter = 0;
    $len = count($_POST);

    foreach ($_POST as $key => $value) {
        if ($key !== 'seatMovieID') {
            $updateQuery = "UPDATE seats SET " . $key . "=1 WHERE seatMovieId=" . $seatMovieID . ";";
            mysqli_query($db, $updateQuery);
            $stringOfSeats = $stringOfSeats . $key;
        }
        if ($counter !== $len - 1 && $key !== 'seatMovieID') {
            // Last element
            $stringOfSeats = $stringOfSeats . ', ';
        }
        $counter++;
    }

    $createOrderQuery = "INSERT INTO orders VALUES (0, {$userID}, {$seatMovieID}, '{$stringOfSeats}');";
    mysqli_query($db, $createOrderQuery);

    header('Location: /reservation.php?movieID=' . $seatMovieID . "&success=1");
}