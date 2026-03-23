<?php
include("config.php");

$message = "";

if (isset($_POST['apply'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $college = trim($_POST['college']);
    $domain = trim($_POST['domain']);
    $message_text = trim($_POST['message']);

    $resume = $_FILES['resume']['name'];
    $tmp = $_FILES['resume']['tmp_name'];

    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
    $file_ext = strtolower(pathinfo($resume, PATHINFO_EXTENSION));

    if ($name == "" || $email == "" || $phone == "" || $college == "" || $domain == "" || $resume == "") {

        $message = "All fields are required";

    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {

        $message = "Phone number must be 10 digits";

    } elseif (!in_array($file_ext, $allowed)) {

        $message = "Only JPG, PNG or PDF files allowed";

    } else {

        $folder = "uploads/" . $resume;
        move_uploaded_file($tmp, $folder);

        $stmt = $conn->prepare("INSERT INTO applications(name,email,phone,college,domain,resume,message) VALUES(?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssss", $name, $email, $phone, $college, $domain, $resume, $message_text);

        if ($stmt->execute()) {
            $message = "Application Submitted Successfully!";
        } else {
            $message = "Error submitting application";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Apply for Internship</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark px-3">

        <a class="navbar-brand" href="#">
            <img src="images/logo.jpeg" style="width:40px">
        </a>

        <a class="navbar-brand fw-bold text-primary" href="#">Inter Connect</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="internships.php">Internships</a></li>
                <li class="nav-item"><a class="nav-link active" href="apply.php">Apply</a></li>
            </ul>
        </div>

    </nav>

    <div class="container mt-5" style="max-width:600px;">

        <h3 class="text-center mb-4">Apply for Internship</h3>

        <?php if ($message != "") { ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow mb-5">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" pattern="[0-9]{10}" maxlength="10"
                    title="Enter 10 digit mobile number" required>
            </div>

            <div class="mb-3">
                <label>College Name</label>
                <input type="text" name="college" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Select Internship Domain</label>

                <select name="domain" class="form-control" required>
                    <option value="">Select Domain</option>
                    <option>Web Development</option>
                    <option>Data Science</option>
                    <option>Machine Learning</option>
                    <option>Digital Marketing</option>
                    <option>UI/UX Design</option>
                </select>

            </div>

            <div class="mb-3">
                <label>Upload Resume</label>

                <input type="file" name="resume" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>

                <small class="text-muted">
                    Only JPG, PNG, PDF allowed
                </small>

            </div>

            <div class="mb-3">
                <label>Why do you want this internship?</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>

            <button type="submit" name="apply" class="btn btn-primary w-100">
                Submit Application
            </button>

            <a href="home.php" class="btn btn-primary w-100 mt-3">
                Back
            </a>

        </form>

    </div>


    <!-- Footer -->

    <footer class="bg-dark text-light pt-5 pb-4">

        <div class="container-fluid px-5">

            <div class="row">

                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning">Interconnect</h5>
                    <p>Know More About Your Career and Grow with the easy way</p>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning">Links</h5>
                    <p><a href="home.php" class="text-light text-decoration-none">Home</a></p>
                    <p><a href="about.php" class="text-light text-decoration-none">About Us</a></p>
                    <p><a href="internships.php" class="text-light text-decoration-none">Internships</a></p>
                    <p><a href="apply.php" class="text-light text-decoration-none">Apply</a></p>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning">Contact</h5>
                    <p><i class="bi bi-house-door-fill"></i> Kolhapur, Maharashtra, India</p>
                    <p><i class="bi bi-envelope-fill"></i> support@internship.com</p>
                    <p><i class="bi bi-phone-fill"></i> +91 98XXX XXXXX</p>
                </div>

            </div>

            <hr class="mb-3">
            <p class="text-center m-0">© 2026 All Rights Reserved.</p>

        </div>

    </footer>

</body>

</html>