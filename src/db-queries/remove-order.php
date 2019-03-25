<?php
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIEJE prihlaseny
    header('Location: /');
    exit;
}
include '../templates/db-config.php';

$orderID = $_GET['orderID'];

$selectQuery = "SELECT orderID, movieID, orderedSeat from orders WHERE orderID={$orderID};";
$selectResult = mysqli_query($db, $selectQuery);
$row = mysqli_fetch_assoc($selectResult);
$arrayOfSeats = explode(', ', $row['orderedSeat']);
foreach ($arrayOfSeats as $key => $value) {
    $updateSeatQuery = "UPDATE seats SET {$value}=0 WHERE seatMovieID={$row['movieID']};";
    echo $updateSeatQuery;
    echo "<br>";
    mysqli_query($db, $updateSeatQuery);
}
$deleteQuery = "DELETE FROM orders WHERE orderID={$orderID};";
mysqli_query($db, $deleteQuery);

if (isset($_GET['all-orders'])) {
    header('Location: /all-orders.php');
    exit;
}
header('Location: /orders.php');
exit;