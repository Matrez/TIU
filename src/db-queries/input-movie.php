<?php
include '../templates/db-config.php';
session_start();
if ($_SESSION['admin'] != true) {
    // Pouzivatel NIE JE admin
    header('Location: /');
    exit;
} else {
    // Pouzivatel JE admin
    $movieTitle = $_POST['title'];
    $movieDesc = $_POST['desc'];

    $insertSeatQuery = "INSERT INTO seats VALUES (0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);";
    mysqli_query($db, $insertSeatQuery);

    $selectSeatQuery = "SELECT seatMovieID FROM seats ORDER BY seatMovieID DESC LIMIT 1;";
    $seatResult = mysqli_query($db, $selectSeatQuery);

    // Storing ID of movie/seat/image
    $row = mysqli_fetch_assoc($seatResult);

    $info = pathinfo($_FILES['image']['name']);
    $ext = $info['extension']; // Gets the extension of the file
    $newname = $row['seatMovieID'] . "." . $ext;
    $target = '../img/moviesimg/' . $newname;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Uklada vo formate "INSERT INTO movies VALUES (0, 'title', 'desc', 'imageLink', 3);
    $insertMovieQuery = "INSERT INTO movies VALUES 
(0, '" . $movieTitle . "', '" . $movieDesc . "', '" . $newname . "', " . $row['seatMovieID'] . ");";
    mysqli_query($db, $insertMovieQuery);


    header('Location: /admin-page.php?succes=1');
}