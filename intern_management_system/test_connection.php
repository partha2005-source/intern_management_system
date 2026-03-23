<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "internship_database", 3307);

if ($conn) {
    echo "Database Connected Successfully!";
} else {
    echo "Connection Failed!";
}
?>