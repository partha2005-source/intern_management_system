<?php
include("../auth.php");   // handles session + login
include("../config.php");

$intern_id = $_SESSION['intern_id'];

/* Update status */
if (isset($_POST['update_status'])) {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    // Update only if task belongs to this intern (safety)
    mysqli_query($conn, "UPDATE tasks SET status='$status' WHERE id='$task_id' AND intern_id='$intern_id'");
}

/* Get tasks */
$result = mysqli_query($conn, "SELECT * FROM tasks WHERE intern_id='$intern_id'");
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Tasks</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <!-- Back Button -->
        <a href="intern_dashboard.php" class="btn btn-primary mb-3">Back</a>

        <h3>Your Assigned Tasks</h3>

        <table class="table table-bordered table-striped mt-4">

            <thead class="table-dark">
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $row['task_title']; ?>
                        </td>

                        <td>
                            <?php echo $row['task_description']; ?>
                        </td>

                        <td>
                            <?php
                            if ($row['status'] == "Completed") {
                                echo "<span class='text-success'>Completed</span>";
                            } elseif ($row['status'] == "In Process") {
                                echo "<span class='text-warning'>In Process</span>";
                            } else {
                                echo "<span class='text-secondary'>Pending</span>";
                            }
                            ?>
                        </td>

                        <td>

                            <form method="POST">

                                <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">

                                <select name="status" class="form-select">

                                    <option value="Pending" <?php if ($row['status'] == "Pending")
                                        echo "selected"; ?>
                                        >Pending</option>
                                    <option value="In Process" <?php if ($row['status'] == "In Process")
                                        echo "selected"; ?>
                                        >In Process</option>
                                    <option value="Completed" <?php if ($row['status'] == "Completed")
                                        echo "selected"; ?>
                                        >Completed</option>

                                </select>

                                <button type="submit" name="update_status" class="btn btn-primary btn-sm mt-2">
                                    Update
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</body>

</html>