<?php
include("../config.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM applications WHERE id='$id'");
    header("Location: view_applications.php");
}

$result = mysqli_query($conn, "SELECT * FROM applications ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Applications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h3>Internship Applications</h3>

        <a href="admin_dashboard.php" class="btn btn-primary mb-3">Back</a>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>College</th>
                    <th>Domain</th>
                    <th>Resume</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

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
                                <?php echo $row['phone']; ?>
                            </td>

                            <td>
                                <?php echo $row['college']; ?>
                            </td>

                            <td>
                                <?php echo $row['domain']; ?>
                            </td>

                            <td>
                                <a href="../uploads/<?php echo $row['resume']; ?>" target="_blank" class="btn btn-sm btn-info">
                                    View
                                </a>
                            </td>

                            <td>
                                <?php echo $row['message']; ?>
                            </td>

                            <td>

                                <a href="view_applications.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>

                            </td>

                        </tr>

                        <?php
                    }
                } else {
                    ?>

                    <tr>
                        <td colspan="9" class="text-center">No Applications Found</td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</body>

</html>