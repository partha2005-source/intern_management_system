<?php
session_start();
include("../config.php");

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {

        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);

            $_SESSION['admin_id'] = $row['id'];   // IMPORTANT
            $_SESSION['admin_name'] = $row['Name'];
            $_SESSION['admin_email'] = $row['email'];

            header("Location: admin_dashboard.php");
            exit();

        } else {
            $error = "Invalid Email or Password!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="card p-4 shadow" style="max-width:400px;margin:auto;">

            <h4 class="text-center mb-3">Admin Login</h4>

            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100">
                    Login
                </button>

            </form>

             <a href="../internships.php" class="btn btn-primary mb-3 mt-3">Back</a>

        </div>
    </div>

</body>

</html>