<?php
include("../auth.php");
include("../config.php");

$intern_id = $_SESSION['intern_id'];

/* Fetch attendance */
$result = mysqli_query(
    $conn,
    "SELECT * FROM attendance
    WHERE intern_id='$intern_id'
    ORDER BY date DESC"
);
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h3>My Attendance</h3>

        <a href="intern_dashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>

        <table class="table table-bordered">

            <tr>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $row['date']; ?>
                        </td>

                        <!-- ✅ 12-HOUR FORMAT -->
                        <td>
                            <?php
                            echo !empty($row['check_in'])
                                ? date("h:i A", strtotime($row['check_in']))
                                : "-";
                            ?>
                        </td>

                        <td>
                            <?php
                            echo !empty($row['check_out'])
                                ? date("h:i A", strtotime($row['check_out']))
                                : "-";
                            ?>
                        </td>

                        <td>
                            <?php
                            if ($row['status'] == "Present") {
                                echo "<span class='text-success'>Present</span>";
                            } elseif ($row['status'] == "Half Day") {
                                echo "<span class='text-warning'>Half Day</span>";
                            } else {
                                echo "<span class='text-secondary'>Pending</span>";
                            }
                            ?>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No attendance found</td></tr>";
            }
            ?>

        </table>

    </div>

</body>

</html>