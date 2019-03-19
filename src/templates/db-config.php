<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

define("DB_HOST", "localhost");
define("DB_USER", "tiu");
define("DB_PASS", "tiu");
define("DB_NAME", "tiu");

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$createUserTable = 'CREATE TABLE IF NOT EXISTS users (
userID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(64) NOT NULL,
password_hash CHAR(60) NOT NULL
);';

$createSeatTable = 'CREATE TABLE IF NOT EXISTS seats (
seatMovieID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
seat1 TINYINT UNSIGNED NOT NULL,
seat2 TINYINT UNSIGNED NOT NULL,
seat3 TINYINT UNSIGNED NOT NULL,
seat4 TINYINT UNSIGNED NOT NULL,
seat5 TINYINT UNSIGNED NOT NULL,
seat6 TINYINT UNSIGNED NOT NULL,
seat7 TINYINT UNSIGNED NOT NULL,
seat8 TINYINT UNSIGNED NOT NULL,
seat9 TINYINT UNSIGNED NOT NULL,
seat10 TINYINT UNSIGNED NOT NULL,
seat11 TINYINT UNSIGNED NOT NULL,
seat12 TINYINT UNSIGNED NOT NULL,
seat13 TINYINT UNSIGNED NOT NULL,
seat14 TINYINT UNSIGNED NOT NULL,
seat15 TINYINT UNSIGNED NOT NULL,
seat16 TINYINT UNSIGNED NOT NULL,
seat17 TINYINT UNSIGNED NOT NULL,
seat18 TINYINT UNSIGNED NOT NULL,
seat19 TINYINT UNSIGNED NOT NULL,
seat20 TINYINT UNSIGNED NOT NULL
);';

$createMovieTable = 'CREATE TABLE IF NOT EXISTS movies (
movieID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(64) NOT NULL,
description VARCHAR(1024) NOT NULL,
seatMovieID INT UNSIGNED NOT NULL,
FOREIGN KEY (seatMovieID) REFERENCES seats(seatMovieID)
);';

$createOrderTable = 'CREATE TABLE IF NOT EXISTS orders (
orderID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userID INT UNSIGNED NOT NULL,
movieID INT UNISGNED NOT NULL,
orderedSeats varchar(128) NOT NULL,
FOREIGN KEY (userID) REFERENCES users(userID),
FOREIGN KEY (movieID) REFERENCES movies(movieID)
);';

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

mysqli_query($db, $createUserTable);
mysqli_query($db, $createMovieTable);
mysqli_query($db, $createSeatTable);
mysqli_query($db, $createOrderTable);
