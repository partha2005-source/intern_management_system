<?php
include("../auth.php");
include("../config.php");

date_default_timezone_set("Asia/Kolkata");

$intern_id = $_SESSION['intern_id'];
$today = date("Y-m-d");

// ✅ Store in DB (24-hour format for accuracy)
$time = date("H:i:s");

// Check today's attendance
$query = mysqli_query(
    $conn,
    "SELECT * FROM attendance 
    WHERE intern_id='$intern_id' AND date='$today'"
);

if (mysqli_num_rows($query) == 0) {

    // ✅ ONLY check-in (status pending)
    mysqli_query(
        $conn,
        "INSERT INTO attendance (intern_id, date, check_in, status)
        VALUES ('$intern_id', '$today', '$time', 'Pending')"
    );
}

// Redirect back
header("Location: intern_dashboard.php");
exit();
?>