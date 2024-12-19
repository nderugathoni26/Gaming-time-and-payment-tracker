<?php
// Assuming you're using a database connection
include('../Main/db.php'); // Include your DB connection file

// Fetch games from the database
$query = "SELECT * FROM games"; // Adjust the table name as necessary
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Handle the edit form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_game_id'])) {
    $game_id = $_POST['edit_game_id'];
    $title = $_POST['title'];
    $price_per_hour = $_POST['price_per_hour'];
    $category = $_POST['category'];
    $age_bracket = $_POST['age_bracket'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Handle image upload if a new image is provided
    if ($image) {
        // Set image path
        $image_path = 'uploads/' . basename($image);
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // Keep the old image if no new one is uploaded
        $query = "SELECT image FROM games WHERE id = '$game_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image'];  // Ensure this is the old image path
    }

    // Update game details in the database
    $query = "UPDATE games SET title = '$title', price_per_hour = '$price_per_hour', category = '$category', age_bracket = '$age_bracket', image = '$image_path' WHERE id = '$game_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF']); // Reload the page to see changes
        exit();
    } else {
        echo "Error updating game: " . mysqli_error($conn);
    }
}

// Handle the delete action
if (isset($_GET['delete_game_id'])) {
    $game_id = $_GET['delete_game_id'];

    // Delete the game from the database
    $query = "DELETE FROM games WHERE id = '$game_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: " . $_SERVER['PHP_SELF']); // Reload the page to remove deleted game
        exit();
    } else {
        echo "Error deleting game: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Games</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
         body {
        background-image: url('../images/players.jpg');
        background-size: fill;
        background-repeat: no-repeat;
        background-position: center;
        color: white;
    }

    .container {
        margin-top: 50px;
    }

    /* Add a scrollable area for cards */
    .card-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        max-height: 70vh; /* Limit the height */
        overflow-y: auto; /* Enable vertical scrolling */
        padding: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2); /* Optional for better visuals */
        border-radius: 10px;
    }

    .card {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        width: 250px;
        text-align: center;
        overflow: hidden;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
    }

    .card-footer {
        background: rgba(0, 0, 0, 0.7);
        border-top: 1px solid #444;
        padding: 10px;
    }

    .btn-action {
        margin: 5px;
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

    .modal-content {
        background-color: #333;
        color: #fff;
        border-radius: 15px;
    }

    /* Navbar styling */
    .navbar {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    h2 {
        color: black !important;
    }

    .navbar-brand i {
        font-size: 1.4rem;
    }

    .nav-link {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    /* Add scrollbar styles for better visuals */
    .card-wrapper::-webkit-scrollbar {
        width: 8px;
    }

    .card-wrapper::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .card-wrapper::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
    }

    .card-wrapper::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.7);
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

    <!-- Manage Games Cards -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Manage Added Games</h2>
        <div class="card-wrapper">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card mb-3">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Game Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                        <p class="card-text"><strong>Price Per Hour:</strong> $<?php echo htmlspecialchars($row['price_per_hour']); ?></p>
                        <p class="card-text"><strong>Age Bracket:</strong> <?php echo htmlspecialchars($row['age_bracket']); ?></p>
                    </div>
                    <div class="card-footer">
                        <!-- Edit Button: Trigger Modal -->
                        <button class="btn btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</button>

                        <!-- Delete Button: Trigger Modal -->
                        <a href="?delete_game_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-action"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Game Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="edit_game_id" value="<?php echo $row['id']; ?>">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Game Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_hour" class="form-label">Price Per Hour</label>
                                        <input type="number" class="form-control" id="price_per_hour" name="price_per_hour" value="<?php echo htmlspecialchars($row['price_per_hour']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age_bracket" class="form-label">Age Bracket</label>
                                        <input type="text" class="form-control" id="age_bracket" name="age_bracket" value="<?php echo htmlspecialchars($row['age_bracket']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Game Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Gaming Arena | All Rights Reserved</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
