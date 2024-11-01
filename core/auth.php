<?php
session_start();

function requireAuth() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
}

function redirectIfAuthenticated() {
    if (isset($_SESSION['user'])) {
        header("Location: index.php");
        exit;
    }
}
?>
