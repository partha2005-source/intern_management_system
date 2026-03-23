<?php
$conn = mysqli_connect("localhost", "root", "", "internship_database");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>