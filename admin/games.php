<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming_arena";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Variable to hold success or error messages

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $price_per_hour = $conn->real_escape_string($_POST['price_per_hour']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $age_bracket = $conn->real_escape_string($_POST['age_bracket']);
    
    // Handle file upload
    $target_dir = "uploads/";
    
    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_name = basename($_FILES["game_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $upload_ok = true;

    // Check if file is an actual image
    $check = getimagesize($_FILES["game_image"]["tmp_name"]);
    if ($check === false) {
        $message = "<div class='alert alert-danger'>File is not an image.</div>";
        $upload_ok = false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $message = "<div class='alert alert-danger'>Sorry, file already exists.</div>";
        $upload_ok = false;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["game_image"]["size"] > 5000000) {
        $message = "<div class='alert alert-danger'>Sorry, your file is too large.</div>";
        $upload_ok = false;
    }

    // Allow only certain file formats
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ["jpg", "jpeg", "png", "gif"])) {
        $message = "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG, and GIF files are allowed.</div>";
        $upload_ok = false;
    }

    // Try to upload file
    if ($upload_ok) {
        if (move_uploaded_file($_FILES["game_image"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO games (title, price_per_hour, description, category, age_bracket, image_path)
                    VALUES ('$title', '$price_per_hour', '$description', '$category', '$age_bracket', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert alert-success'>New game added successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Sorry, your file was not uploaded.</div>";
        }
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/venom.jpg'); /* Add your background image path here */
            background-size: cover;
            background-position: center;
            color: white;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: 0 auto;
        }

        .card-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 50px;
        }

        .card {
            width: 300px;
            margin: 10px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .card img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card h5 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
        }

        .card .price {
            font-size: 18px;
            font-weight: bold;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Smaller navbar styles */
        .navbar {
            padding: 0.1rem 0rem;
            font-size: 0.9rem;
        }

        .navbar-brand i {
            font-size: 1.0rem;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gamepad"></i> Gaming Arena - Player Panel
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
                            <a class="nav-link" href="viewgames.php">view Added Games</a>
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

    <!-- Form to Add New Game -->
    <div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Add a New Game</h2>

        <!-- Display success or error message -->
        <?php if (!empty($message)) echo $message; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Game Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="Game title">
            </div>
            <div class="mb-3">
                <label for="price_per_hour" class="form-label">Price Per Hour ($)</label>
                <input type="number" class="form-control" id="price_per_hour" name="price_per_hour" required placeholder="price">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Game Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Description"></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Game Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="Action">Action</option>
                    <option value="Simulation">Sport</option>
                    <option value="Adventure">Adventure</option>
                    <option value="RPG">RPG</option>
                    <option value="Strategy">Strategy</option>
                    <option value="Simulation">Simulation</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="age_bracket" class="form-label">Age Bracket</label>
                <select class="form-control" id="age_bracket" name="age_bracket" required>
                    <option value="All Ages">All Ages</option>
                    <option value="13+">13+</option>
                    <option value="18+">18+</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="game_image" class="form-label">Game Image</label>
                <input type="file" class="form-control" id="game_image" name="game_image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Game</button>
        </form>
    </div>
</div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Gaming Arena. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
