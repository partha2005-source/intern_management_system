<?php
include('../config.php');

$name = "Super Admin";
$email = "admin@gmail.com";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "INSERT INTO admin (Name, email, password) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
mysqli_stmt_execute($stmt);

echo "Admin Created Successfully!";
?>