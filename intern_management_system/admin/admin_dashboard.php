<?php
session_start();
include("../config.php");

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$total_interns = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM intern"
))['total'];

$total_tasks = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tasks"
))['total'];

$completed = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tasks WHERE status='Completed'"
))['total'];

$pending = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tasks WHERE status='Pending'"
))['total'];

$process = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM tasks WHERE status='In Process'"
))['total'];

$attendance = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM attendance WHERE date=CURDATE()"
))['total'];

$applications = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM applications"
))['total'];

$absent = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM intern
WHERE id NOT IN (SELECT intern_id FROM attendance WHERE date=CURDATE())"
))['total'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">

                <h5 class="text-center mb-4">Admin Panel</h5>

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin_dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="add_intern.php">Add Intern</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="view_intern.php">View Intern</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="attendance.php">Attendance</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Monthly Attendance</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="assign_task.php">Tasks</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="view_applications.php">Applications</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>

            <div class="col-md-10 p-4">

                <h3>Welcome Admin
                    <?php echo $_SESSION['admin_name']; ?>
                </h3>

                <div class="row mt-4 g-4">

                    <div class="col-md-3">
                        <div class="card bg-primary text-white p-3">
                            <h5>Total Interns</h5>
                            <h3>
                                <?php echo $total_interns; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-success text-white p-3">
                            <h5>Total Tasks</h5>
                            <h3>
                                <?php echo $total_tasks; ?>
                            </h3>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-3">
                        <div class="card bg-info text-white p-3">
                            <h5>Completed</h5>
                            <h3>
                                <?php echo $completed; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-warning text-dark p-3">
                            <h5>Pending</h5>
                            <h3>
                                <?php echo $pending; ?>
                            </h3>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="col-md-3">
                        <div class="card bg-secondary text-white p-3">
                            <h5>In Process</h5>
                            <h3>
                                <?php echo $process; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-dark text-white p-3">
                            <h5>Attendance</h5>
                            <h3>
                                <?php echo $attendance; ?>
                            </h3>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="col-md-3">
                        <div class="card bg-primary text-white p-3">
                            <h5>Applications</h5>
                            <h3>
                                <?php echo $applications; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-danger text-white p-3">
                            <h5>Absent</h5>
                            <h3>
                                <?php echo $absent; ?>
                            </h3>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>