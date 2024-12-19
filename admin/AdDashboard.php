<?php
// Database connection
$servername = "localhost";
$username = "root";  // Change this to your DB username
$password = "";  // Change this to your DB password
$dbname = "gaming_arena";  // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to calculate the total amount paid and total hours played
$sql = "SELECT SUM(amount_paid) AS total_amount_paid, SUM(hours_played) AS total_hours_played
        FROM game_records";

// Execute the query
$result = $conn->query($sql);

// Initialize variables to display the total amount paid and total hours played
$totalAmountPaid = "$0";
$totalHoursPlayed = "0";

// If the query returns results, fetch the data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalAmountPaid = "$" . number_format($row['total_amount_paid'], 2);
        $totalHoursPlayed = $row['total_hours_played'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gaming Arena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Full page height and background image */
        body, html {
            height: 100%;
            margin: 0;
            background: url('../images/admin3.jpg') no-repeat center center/cover; /* Add your background image URL here */
            color: white;
            overflow: hidden;
        }

        /* Make the body a flex container to push the footer to the bottom */
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Content Wrapper */
        .content-wrapper {
            flex: 1; /* This allows the content to expand and fill the remaining space */
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(0, 0, 0, 0.7); /* Adds a dark overlay for readability */
            border-radius: 10px;
        }

        .card-wrapper {
            display: flex;
            flex-direction: column; /* Align cards vertically */
            align-items: flex-start; /* Align cards to the left */
            gap: 20px;
            margin-bottom: 50px;
        }

        .card {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .card h4 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card .icon {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .card .value {
            font-size: 30px;
            font-weight: bold;
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

        /* Quote Section Styling */
        .quote-section {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 80%;
            margin: 0 auto 30px;
        }

        .quote p {
            font-size: 24px;
            color: white;
            font-style: italic;
        }

        .quote footer {
            font-size: 20px;
            color: #f39c12;
            margin-top: 10px;
        }

        /* Footer styling */
        footer {
            background-color: #1f1f1f;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
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
                            <a class="nav-link" href="AdDashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="games.php">Add Games</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewgames.php">View Added Games</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tournament.php">GAMES..!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="record.php">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Adlogin.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper (Dashboard Info) -->
        <div class="content-wrapper">
            <h1>Admin Dashboard</h1>
            
            <!-- Inspirational Quote Section -->
            <div class="quote-section">
                <blockquote class="quote">
                    <p>"In the world of gaming, it's not about the hours you spend, but the moments you create."</p>
                    <footer>- Aura</footer>
                </blockquote>
            </div>

            <div class="card-wrapper">
                <!-- Total Money Paid Card -->
                <div class="card">
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h4>Total Money Paid</h4>
                    <div class="value"><?php echo $totalAmountPaid; ?></div>
                </div>

                <!-- Total Hours Played Card -->
                <div class="card">
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Total Hours Played</h4>
                    <div class="value"><?php echo $totalHoursPlayed; ?> hrs</div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Gaming Arena. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
