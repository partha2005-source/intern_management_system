<?php
include("../config.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_intern.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM intern WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: view_intern.php");
    exit();
}

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE intern
                        SET name='$name', email='$email'
                        WHERE id='$id'");

    header("Location: view_intern.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Intern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h3>Update Intern</h3>

    <form method="POST">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control"
                required>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="view_intern.php" class="btn btn-secondary">Cancel</a>

    </form>

</body>

</html>