<?php
session_start();
include '../templates/db-config.php';

$username = $_POST['name'];
$password = $_POST['password'];

$querySelectUser = "SELECT * FROM users WHERE username='" . $username . "';";

$result = mysqli_query($db, $querySelectUser);

if (mysqli_num_rows($result) > 0) {
    // Output data of user
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password_hash'])) {
        // Hesla sa zhoduju
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['memberid'] = $row['id'];
        header('Location: /kino.php');
        exit;
    } else {
        // Hesla sa nezhoduju
        userOrPasswordNotExist();
    }
} else {
    userOrPasswordNotExist();
}

function userOrPasswordNotExist() {
    header('Location: /index.php?wrongUsernameOrPassword=1');
    exit;
}