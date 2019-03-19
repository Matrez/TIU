<?php
include '../templates/db-config.php';
session_start();
if ($_SESSION['admin'] != true) {
    // Pouzivatel NIE JE admin
    header('Location: /');
    exit;
} else {
    // Pouzivatel JE admin
    $dropOrders = "DROP TABLE orders;";
    $dropMovies = "DROP TABLE movies;";
    $dropSeats = "DROP TABLE seats;";
    $dropUsers = "DROP TABLE users;";

    mysqli_query($db, $dropOrders);
    mysqli_query($db, $dropMovies);
    mysqli_query($db, $dropSeats);
    mysqli_query($db, $dropUsers);

    header('Location: /admin-page.php');
}