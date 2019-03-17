<?php
session_start();
if ($_SESSION['loggedin'] != true) {
    // Pouzivatel NIEJE prihlaseny
    header('Location: /');
} else {
    // Pouzivatel JE prihlaseny
    include 'src/'
}