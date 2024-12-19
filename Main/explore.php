<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Games - Gaming Arena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Page Background */
        body {
            background-color: #1f1f1f;
            color: white;
        }

        /* Header Section */
        header {
            background: url('../images/Gm4.jpg') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        header h1 {
            font-size: 5rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        /* Game Cards */
        .game-card {
            background-color: #292929;
            color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .game-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            max-height: 200px;
            object-fit: cover;
        }

        .game-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .game-card h5 {
            font-size: 1.25rem;
            margin: 0.5rem 0;
        }

        .game-card p {
            font-size: 1rem;
            margin: 0.25rem 0;
        }

        /* Category Badge */
        .badge {
            background-color: #007bff;
            font-size: 0.8rem;
        }

        /* Navbar Styles */
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

        /* Tooltip message */
        .tooltip-inner {
            background-color: #dc3545 !important; /* Red for warning */
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gamepad"></i> Gaming Arena
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="explore.php">Explore</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
    </header>

    <!-- Game Cards Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Collection</h2>
            <div class="row g-4">
                <!-- Game Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/adventure.avif" class="card-img-top" alt="Game 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Adventure Quest</h5>
                            <p><span class="badge">Adventure</span></p>
                            <p class="card-text">Price: $6/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
                <!-- Game Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/puzzle.jpg" class="card-img-top" alt="Game 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Puzzle Master</h5>
                            <p><span class="badge">Puzzle</span></p>
                            <p class="card-text">Price: $3/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
                <!-- Game Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/racing.jpg" class="card-img-top" alt="Game 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Racing Championship</h5>
                            <p><span class="badge">Racing</span></p>
                            <p class="card-text">Price: $7/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
                <!-- Game Card 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/space.png" class="card-img-top" alt="Game 4">
                        <div class="card-body text-center">
                            <h5 class="card-title">Space Invaders</h5>
                            <p><span class="badge">Sci-Fi</span></p>
                            <p class="card-text">Price: $5/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
                <!-- Game Card 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/shooter.avif" class="card-img-top" alt="Game 5">
                        <div class="card-body text-center">
                            <h5 class="card-title">Shooter Showdown</h5>
                            <p><span class="badge">Shooter</span></p>
                            <p class="card-text">Price: $8/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
                <!-- Game Card 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card game-card">
                        <img src="../images/fantacy.jpg" class="card-img-top" alt="Game 6">
                        <div class="card-body text-center">
                            <h5 class="card-title">Fantasy World</h5>
                            <p><span class="badge">Fantasy</span></p>
                            <p class="card-text">Price: $4/hour</p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="You need to login to play!">Play Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white py-4">
        <p>&copy; 2024 Gaming Arena. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Enable tooltips
        var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>
</body>
</html>
