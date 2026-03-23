<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../config.php");

date_default_timezone_set("Asia/Kolkata");

if (isset($_SESSION['intern_id'])) {
    header("Location: intern_dashboard.php");
    exit();
}

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "All fields are required!";
    } else {

        $stmt = $conn->prepare("SELECT id, name, password FROM intern WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            if ($password == $row['password'] || password_verify($password, $row['password'])) {

                $_SESSION['intern_id'] = $row['id'];
                $_SESSION['intern_name'] = $row['name'];

                header("Location: intern_dashboard.php");
                exit();

            } else {
                $message = "Incorrect Password!";
            }

        } else {
            $message = "Email not found!";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Intern Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow p-4" style="width: 400px; border-radius: 12px;">
    
    <h3 class="text-center mb-4">Intern Login</h3>

    <?php if ($message != ""): ?>
            <div class="alert alert-danger text-center">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control bg-light" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control bg-light" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 mb-2">
                Login
            </button>

        </form>

        <a href="../internships.php" class="btn btn-primary w-100">
            Back
        </a>

    </div>

</body>

</html>