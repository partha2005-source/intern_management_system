<?php
include("../auth.php");
include("../config.php");

date_default_timezone_set("Asia/Kolkata");

$selected_intern = "";

if (isset($_GET['intern_id'])) {
    $selected_intern = intval($_GET['intern_id']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Intern Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <!-- ✅ Back Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Select Intern</h4>
            <a href="admin_dashboard.php" class="btn btn-primary">
                Back to Dashboard
            </a>
        </div>

        <select class="form-control mb-3" onchange="window.location='attendance.php?intern_id='+this.value">

            <option value="">Select Intern</option>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM intern");

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($selected_intern == $row['id'])
                    echo "selected"; ?>>
                    <?php echo $row['name']; ?>
                </option>
            <?php } ?>
        </select>

        <?php if ($selected_intern != "") {

            /* ✅ Get attendance data */
            $query = mysqli_query($conn, "
                SELECT * FROM attendance
                WHERE intern_id='$selected_intern'
            ");

            $attendance_data = [];

            while ($row = mysqli_fetch_assoc($query)) {
                $attendance_data[$row['date']] = $row;
            }

            /* ✅ Show last 30 days */
            $days = 30;
            $dates = [];

            for ($i = 0; $i < $days; $i++) {
                $dates[] = date("Y-m-d", strtotime("-$i days"));
            }
            ?>

            <table class="table table-bordered text-center">

                <tr class="table-dark">
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($dates as $date) {

                    if (isset($attendance_data[$date])) {

                        $row = $attendance_data[$date];

                        $check_in = !empty($row['check_in']) ? date("h:i A", strtotime($row['check_in'])) : "-";
                        $check_out = !empty($row['check_out']) ? date("h:i A", strtotime($row['check_out'])) : "-";

                        // ✅ Status Logic
                        if (!empty($row['check_out'])) {
                            $status = $row['status']; // Present / Half Day
                        } else {
                            $status = "Pending";
                        }

                    } else {
                        $check_in = "-";
                        $check_out = "-";
                        $status = "Absent";
                    }
                    ?>

                    <tr>
                        <td>
                            <?php echo $date; ?>
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

        <?php } ?>

    </div>

</body>

</html>