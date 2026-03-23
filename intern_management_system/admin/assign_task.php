<?php
include("../config.php");

$message = "";

/* Assign Task */
if (isset($_POST['assign'])) {

    $intern_id = $_POST['intern_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO tasks (intern_id, task_title, task_description, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("iss", $intern_id, $title, $description);

    if ($stmt->execute()) {
        $message = "Task Assigned Successfully!";
    } else {
        $message = "Error assigning task";
    }
}

/* Selected Intern */
$selected_intern = "";
if (isset($_GET['intern_id'])) {
    $selected_intern = $_GET['intern_id'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Assign Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5" style="max-width:900px;">

        <h4>Assign Task to Intern</h4>

        <?php if ($message != "") { ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">

                <label>Select Intern</label>

                <select name="intern_id" class="form-control"
                    onchange="window.location='assign_task.php?intern_id='+this.value">

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

            </div>

            <div class="mb-3">
                <label>Task Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Task Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <!-- Buttons Side by Side -->
            <div class="d-flex gap-3 mt-3">

                <button type="submit" name="assign" class="btn btn-primary">
                    Assign Task
                </button>

                <a href="admin_dashboard.php" class="btn btn-primary">
                    Back
                </a>

            </div>

        </form>

        <hr class="mt-5">

        <?php
        /* Show tasks only if intern selected */

        if ($selected_intern != "") {
            ?>

            <h4>Intern Task List</h4>

            <table class="table table-bordered table-primary mt-3">

                <thead class="table-primary">

                    <tr>
                        <th>Task Title</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    $query = mysqli_query($conn, "SELECT * FROM tasks WHERE intern_id='$selected_intern'");

                    while ($row = mysqli_fetch_assoc($query)) {

                        ?>

                        <tr>

                            <td>
                                <?php echo $row['task_title']; ?>
                            </td>

                            <td>
                                <?php echo $row['task_description']; ?>
                            </td>

                            <td>
                                <?php echo $row['status']; ?>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        <?php } ?>

    </div>

</body>

</html>