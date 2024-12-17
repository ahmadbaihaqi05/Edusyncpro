<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Fungsi otorisasi untuk role
function authorize($role) {
    if ($_SESSION['role'] !== $role) {
        header('Location: dashboard.php');
        exit;
    }
}
?>
