<?php
session_start();
if (isset($_GET['logOut'])) {
//    $_SESSION = array();
    session_destroy();
    header('Location: /');
} else {
    die('Neprisiel request s getom');
}