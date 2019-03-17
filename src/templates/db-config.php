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
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password_hash CHAR(60) NOT NULL
);';

if (!mysqli_query($db, $createUserTable)) {
    echo "Nepodarilo sa vytvorit zakladne tabulky";
}

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}