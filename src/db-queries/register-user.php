<?php
include '../templates/db-config.php';

$username = $_POST['name'];
$password = $_POST['password'];

if (preg_match('/[^A-Za-z0-9]/', $username)) {
    // Doesn't contain letters or numbers
    die('Username does not contain only letters or numbers');
} else if (strlen($password) < 6) {
    // Password is shorter than 6
    die('Password is shorter than 6 characters');
} else {
    // Success, check if database doesn't contain username
    $result = mysqli_query($db, "SELECT * FROM users WHERE username='" . $username . "';");

    if (mysqli_num_rows($result) >= 1) {
        // Username already exists
        header('Location: /register.php?usernameExists=1');
        exit;
    } else {
        // Username doesn't exists
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $queryInsertUser = "INSERT INTO users(username, password_hash) VALUES ('" . $username . "', '" . $hashedPassword . "')";
        $result = mysqli_query($db, $queryInsertUser);
        if (!$result) {
            //Didnt insert into database
            die('Failed to insert into database');
        } else {
            header('Location: /thank-you-register.php');
            exit;
        }
    }
}
