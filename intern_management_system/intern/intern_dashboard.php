<?php
include("../auth.php");
include("../config.php");

date_default_timezone_set("Asia/Kolkata");

$intern_id = $_SESSION['intern_id'];
$intern_name = $_SESSION['intern_name'];

$today = date("Y-m-d");

/* ================= ATTENDANCE ================= */

$attendance_today = mysqli_query($conn, "
    SELECT * FROM attendance 
    WHERE intern_id='$intern_id' AND date='$today'
");

$today_row = null;

if ($attendance_today && mysqli_num_rows($attendance_today) > 0) {
    $today_row = mysqli_fetch_assoc($attendance_today);
}

/* BUTTON LOGIC */
if (isset($_POST['attendance_btn'])) {

    $time = date("h:i A");

    if ($today_row == null) {
        mysqli_query($conn, "
            INSERT INTO attendance (intern_id, date, check_in)
            VALUES ('$intern_id', '$today', '$time')
        ");
    } else if (empty($today_row['check_out'])) {

        $checkin = strtotime($today_row['check_in']);
        $checkout = strtotime($time);

        $hours = ($checkout - $checkin) / 3600;

        $status = ($hours >= 6) ? "Present" : "Half Day";

        mysqli_query($conn, "
            UPDATE attendance 
            SET check_out='$time', status='$status'
            WHERE intern_id='$intern_id' AND date='$today'
        ");
    }

    header("Location: intern_dashboard.php");
    exit();
}

/* ================= TASK ================= */

$total_tasks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks WHERE intern_id='$intern_id'"));
$completed_tasks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks WHERE intern_id='$intern_id' AND status='Completed'"));
$pending_tasks = $total_tasks - $completed_tasks;

/* ================= ATTENDANCE COUNT ================= */

$attendance_data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) AS total_attendance
    FROM attendance
    WHERE intern_id='$intern_id'
    AND status IN ('Present','Half Day')
"));

$total_attendance = $attendance_data['total_attendance'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Intern Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        .sidebar {
            height: 100vh;
        }

        .card {
            border-radius: 15px;
            border: none;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .welcome-box {
            background: linear-gradient(135deg, #4e73df, #6f42c1);
            color: white;
            padding: 20px;
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h5 class="text-center mb-4">Intern Panel</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="intern_dashboard.php">Dashboard</a>
                    </li> <li class="nav-item">
                        <a class="nav-link text-white" href="intern_attendance.php">My Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="monthly_attendance.php">Monthly Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="intern_tasks.php">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                    </ul>
                </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">

                <!-- Welcome -->
                <div class="welcome-box mb-4">
                    <h4>👋 Welcome,
                        <?php echo $intern_name; ?>
                    </h4>
                    <p>
                        <?php echo date("l, d M Y"); ?>
                    </p>

                    <?php if ($today_row == null) { ?>
                        <p>Status: ❌ Not Checked In</p>
                    <?php } else if (empty($today_row['check_out'])) { ?>
                            <p>Status: ⏳ Checked In at
                            <?php echo $today_row['check_in']; ?>
                            </p>
                    <?php } else { ?>
                            <p>Status: ✅ Attendance Completed</p>
                    <?php } ?>
                </div>

                <!-- Attendance Button -->
                <form method="POST" class="mb-4">
                    <?php if ($today_row == null) { ?>
                        <button type="submit" name="attendance_btn" class="btn btn-success">
                            Check In
                        </button>

                    <?php } else if (empty($today_row['check_out'])) { ?>
                            <button type="submit" name="attendance_btn" class="btn btn-danger">
                                Check Out
                            </button>

                    <?php } else { ?>
                            <button class="btn btn-secondary" disabled>
                                Completed
                            </button>
                    <?php } ?>
                </form>

                <!-- Cards -->
                <div class="row g-4">

                    <div class="col-md-3">
                        <div class="card bg-primary text-white text-center p-3">
                            <h6>Total Tasks</h6>
                            <h3>
                                <?php echo $total_tasks; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-success text-white text-center p-3">
                            <h6>Completed</h6>
                            <h3>
                                <?php echo $completed_tasks; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-danger text-white text-center p-3">
                            <h6>Pending</h6>
                            <h3>
                                <?php echo $pending_tasks; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-warning text-dark text-center p-3">
                            <h6>Attendance</h6>
                            <h3>
                                <?php echo $total_attendance; ?>
                            </h3>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>