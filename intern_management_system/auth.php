<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['intern_id'])) {
    header("Location: intern_login.php");
    exit();
}
?>