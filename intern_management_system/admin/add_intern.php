<?php
include("../config.php");

$message = "";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM intern WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Email already exists!";
    } else {

        $stmt = $conn->prepare("INSERT INTO intern (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "Intern Added Successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Intern</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark px-3">

        <a class="navbar-brand" href="#">
            <img src="logo.jpeg" style="width:40px">
        </a>

        <a class="navbar-brand fw-bold text-primary" href="#">Inter Connect</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="../about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../internships.php">Internships</a></li>
                <li class="nav-item"><a class="nav-link" href="../apply.php">Apply</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5" style="max-width:500px;">

        <h4 class="mb-4 text-center">Add Intern</h4>

        <?php if (!empty($message)) { ?>
            <div class="alert alert-primary">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST" class="border p-4 rounded">

            <div class="mb-3">
                <label class="form-label">Intern Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Intern Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">
                Add Intern
            </button>

        </form>

        <div class="mb-3 mt-4">
        <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
        </div>

    </div>

</body>

</html>