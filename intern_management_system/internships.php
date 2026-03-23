<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Internship Project and Mentor Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('images/cursor3.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
            display: flex;
            align-items: center;
        }

        .hero-section h1 {
            font-size: 48px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: #0d6efd;
        }

        .section-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            transition: 0.3s;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card img {
            padding: 20px;
            height: 180px;
            object-fit: contain;
        }

        /* UPDATED STUDENT IMAGE STYLE */
        .intern-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body> <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark px-3"> <a class="navbar-brand" href="#"> <img
                src="images/logo.jpeg" style="width:40px"> </a> <a class="navbar-brand fw-bold text-primary"
            href="#">Inter Connect</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#nav"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"> <a class="nav-link" href="home.php">Home</a> </li>
                <li class="nav-item"> <a class="nav-link" href="about.php">About Us</a> </li>
                <li class="nav-item"> <a class="nav-link" href="internships.php">Internships</a> </li>
                <li class="nav-item"> <a class="nav-link" href="apply.php">Apply</a> </li>
            </ul>
        </div>
    </nav> <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center align-items-center h-100">
                <div class="col-md-8">
                    <h1 class="fw-bold text-white"> Intern Management System </h1>
                    <p class="text-light"> Track interns, manage tasks, and monitor attendance easily. </p> <a
                        href="admin/admin_login.php" class="btn btn-primary me-3"> Admin Login </a> <a
                        href="intern/intern_login.php" class="btn btn-success"> Intern Login </a>
                </div>
            </div>
        </div>
    </div> <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title"> Our Platform Features </h2>
                <p class="section-subtitle"> Manage interns efficiently with our smart internship tracking system </p>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm"> <img src="images/tracking2.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="fw-bold"> Intern Tracking </h5>
                            <p class="text-muted"> Track intern progress and tasks in one place. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm"> <img src="images/attendance.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="fw-bold"> Attendance </h5>
                            <p class="text-muted"> Track daily attendance of interns easily. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm"> <img src="images/task_management.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="fw-bold"> Task Management </h5>
                            <p class="text-muted"> Assign tasks and monitor intern progress. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Intern Testimonials -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">What Our Interns Say</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/boy1.jpg" class="intern-img">
                        <p>"This platform helped me manage my internship tasks easily."</p>
                        <h6 class="fw-bold">Rahul Sharma</h6> <small class="text-muted">Web Development Intern</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/girl1.jpg" class="intern-img">
                        <p>"Mentor guidance and task tracking made learning smooth."</p>
                        <h6 class="fw-bold">Priya Patel</h6> <small class="text-muted">UI/UX Intern</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/boy2.jpg" class="intern-img">
                        <p>"A very simple and efficient internship management system."</p>
                        <h6 class="fw-bold">Amit Verma</h6> <small class="text-muted">Software Intern</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/girl2.jpg" class="intern-img">
                        <p>"Tracking attendance and tasks became very easy."</p>
                        <h6 class="fw-bold">Neha Singh</h6> <small class="text-muted">Data Analyst Intern</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/boy3.jpg" class="intern-img">
                        <p>"Great experience working with mentors and managing projects."</p>
                        <h6 class="fw-bold">Karan Mehta</h6> <small class="text-muted">Backend Intern</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow p-3 text-center"> <img src="images/girl3.jpg" class="intern-img">
                        <p>"Very helpful platform for monitoring internship progress."</p>
                        <h6 class="fw-bold">Anjali Gupta</h6> <small class="text-muted">Marketing Intern</small>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Call to Action -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Start Your Internship Journey Today</h2>
            <p class="text-muted mb-4"> Join our platform and gain real-world experience. </p> <a href="apply.php"
                class="btn btn-primary btn-lg"> Apply Now </a>
        </div>
    </section> <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-4">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning"> Interconnect </h5>
                    <p> Know More About Your Career and Grow with the easy way </p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning"> Links </h5>
                    <p><a href="home.php" class="text-light text-decoration-none">Home</a></p>
                    <p><a href="about.php" class="text-light text-decoration-none">About Us</a></p>
                    <p><a href="internships.php" class="text-light text-decoration-none">Internships</a></p>
                    <p><a href="apply.php" class="text-light text-decoration-none">Apply</a></p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <h5 class="text-uppercase mb-4 text-warning"> Contact </h5>
                    <p><i class="bi bi-house-door-fill"></i> Kolhapur, Maharashtra, India</p>
                    <p><i class="bi bi-envelope-fill"></i> support@internship.com</p>
                    <p><i class="bi bi-phone-fill"></i> +91 98XXX XXXXX</p>
                </div>
            </div>
            <hr class="mb-3">
            <p class="text-center m-0"> © 2026 All Rights Reserved. </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>