<?php
// Include database connection
include('../Main/db.php');

// Hard-coded credentials
$admin_username = 'WarLord'; // Replace with your desired username
$admin_password = 'WarLord'; // Replace with your desired password

// Initialize variables
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Redirect to admin dashboard
        header('Location: AdDashboard.php');
        exit();
    } else {
        // Error message
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Gaming Arena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Full page height */
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
        }
        
        /* Background Image */
        body {
            background: url('../images/wallpaperflare.com_wallpaper\ 2.jpg') no-repeat center center/cover;
            background-size: cover;
        }

        /* Centering content */
        .content-wrapper {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .login-container {
            background: rgba(0, 0, 0, 0.7); /* Transparent black background */
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            color: white;
        }

        .form-control {
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            font-size: 18px;
        }

        /* Navbar */
        .navbar {
            background-color: #1f1f1f !important;
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700; /* Gold color for hover effect */
        }

        .navbar-brand {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gamepad"></i> Gaming Arena - Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Main/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Main/explore.php">Explore</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Wrapper (Centered Login Form) -->
    <div class="content-wrapper">
        <div class="login-container">
            <h2>Admin Login</h2>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login">Login</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-3 bg-dark text-light text-center">
        <p>&copy; 2024 Gaming Arena. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
