<?php
include("../auth.php");
include("../config.php");

date_default_timezone_set("Asia/Kolkata");

$intern_id = $_SESSION['intern_id'];

$selected_month = isset($_GET['month']) ? intval($_GET['month']) : date("m");

if ($selected_month < 1 || $selected_month > 12) {
    $selected_month = date("m");
}

$selected_year = date("Y");

$month_name = date("F", mktime(0, 0, 0, $selected_month, 1));

/* ✅ Get full attendance data */
$attendance_query = mysqli_query($conn, "
SELECT date, check_in, check_out, status 
FROM attendance
WHERE intern_id = '$intern_id'
AND MONTH(date) = '$selected_month'
AND YEAR(date) = '$selected_year'
");

$attendance_days = [];

while ($row = mysqli_fetch_assoc($attendance_query)) {
    $attendance_days[$row['date']] = $row;
}

$start_date = strtotime("$selected_year-$selected_month-01");
$end_date = strtotime(date("Y-m-t", $start_date));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Monthly Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h3>
            <?php echo $month_name . " " . $selected_year; ?>
        </h3>

        <a href="intern_dashboard.php" class="btn btn-primary mb-3">Back</a>

        <!-- Month Selector -->
        <form method="GET" class="mb-3">
            <select name="month" class="form-control w-25" onchange="this.form.submit()">
                <?php
                for ($m = 1; $m <= 12; $m++) {
                    $name = date("F", mktime(0, 0, 0, $m, 1));
                    $sel = ($m == $selected_month) ? "selected" : "";
                    echo "<option value='$m' $sel>$name</option>";
                }
                ?>
            </select>
        </form>

        <table class="table table-bordered text-center">

            <tr class="table-dark">
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>

            <?php
            for ($d = $start_date; $d <= $end_date; $d = strtotime("+1 day", $d)) {

                $current = date("Y-m-d", $d);

                if (isset($attendance_days[$current])) {

                    $row = $attendance_days[$current];

                    $check_in = $row['check_in'] ?: '-';
                    $check_out = $row['check_out'] ?: '-';

                    // ✅ FIX LOGIC
                    if (!empty($row['check_out'])) {
                        $status = $row['status']; // Present / Half Day
                    } else {
                        $status = "Pending";
                    }

                } else {
                    $check_in = '-';
                    $check_out = '-';
                    $status = "Absent";
                }
                ?>

                <tr>
                    <td>
                        <?php echo $current; ?>
                    </td>
                    <td>
                        <?php echo $check_in; ?>
                    </td>
                    <td>
                        <?php echo $check_out; ?>
                    </td>
                    <td>
                        <?php
                        if ($status == "Present") {
                            echo "<span class='badge bg-success'>Present</span>";
                        } elseif ($status == "Half Day") {
                            echo "<span class='badge bg-warning text-dark'>Half Day</span>";
                        } elseif ($status == "Pending") {
                            echo "<span class='badge bg-secondary'>Pending</span>";
                        } else {
                            echo "<span class='badge bg-danger'>Absent</span>";
                        }
                        ?>
                    </td>
                </tr>

            <?php } ?>

        </table>

    </div>

</body>

</html>