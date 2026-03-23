<?php
include("../config.php");
$result = mysqli_query($conn, "SELECT * FROM intern");
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Intern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h3>Intern List</h3>

    <a href="add_intern.php" class="btn btn-success mb-3">Add New Intern</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>password</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>
                        <?php echo $row['id']; ?>
                    </td>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>
                    <td>
                        <?php echo $row['password']; ?>
                    </td>
                    <td>
                        <a href="update_intern.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Update</a>

                        <a href="delete_intern.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this intern?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="mb-3 mt-4">
        <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
        </div>


</body>

</html>