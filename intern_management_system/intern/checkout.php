<?php
include("../auth.php");
include("../config.php");

$intern_id = $_SESSION['intern_id'];

date_default_timezone_set("Asia/Kolkata");

$today = date("Y-m-d");
$logout_time = date("H:i:s");

// Office timing
$cutoff_time = strtotime("11:00:00"); // login limit
$full_time = strtotime("17:00:00");   // full day logout

// Get today's attendance
$result = mysqli_query(
    $conn,
    "SELECT * FROM attendance
    WHERE intern_id='$intern_id' AND date='$today'"
);

if (mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_assoc($result);

    // ✅ Prevent multiple logout updates
    if (!empty($data['check_out'])) {
        session_destroy();
        header("Location: ../intern_login.php");
        exit();
    }

    $check_in = $data['check_in'];

    if (!empty($check_in)) {

        $login = strtotime($check_in);
        $logout = strtotime($logout_time);

        // ✅ APPLY YOUR EXACT LOGIC
        if ($login <= $cutoff_time && $logout >= $full_time) {
            $status = "Present";
        } elseif ($login <= $cutoff_time && $logout < $full_time) {
            $status = "Half Day";
        } else {
            $status = "Half Day";
        }

        // Update attendance
        mysqli_query(
            $conn,
            "UPDATE attendance
            SET check_out='$logout_time', status='$status'
            WHERE intern_id='$intern_id' AND date='$today'"
        );
    }
}

// Logout session
session_destroy();
header("Location: ../intern_login.php");
exit();
?>