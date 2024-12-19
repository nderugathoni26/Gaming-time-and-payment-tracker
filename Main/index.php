<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Arena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Hero Section */
   /* Hero Section */
   #hero {
    height: 100vh;
    background: #000; /* Fallback background */
}

#heroCarousel img {
    max-height: 100vh;
    width: 100%;
    object-fit: cover; /* Ensures the image scales properly */
}

.carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.carousel-caption h1 {
    font-size: 3rem;
    font-weight: bold;
}

.carousel-caption p {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.carousel-caption .btn {
    font-size: 1.25rem;
    padding: 0.75rem 1.5rem;
}

/* Navbar */
.navbar {
    background-color: #1f1f1f !important;
}

/* Game Cards */
.game-card {
    background-color: #1f1f1f;
    color: white;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.game-card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.game-card:hover {
    transform: scale(3.05);
    transition: transform 7.5s;
}

/* Footer */
footer {
    background-color: #1f1f1f;
    color: #ccc;
    font-size: 14px;
}

    </style>
</head>
<body>
    <!-- Navbar -->
 <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-gamepad"></i> Gaming Arena
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="idex.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="explore.php">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <!-- Hidden Admin Icon -->
                <li class="nav-item">
                    <a href="../admin/Adlogin.php" class="nav-link position-relative" style="opacity: 0.09; text-decoration: none;">
                        <i class="fas fa-user-shield"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1500">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
    
            <!-- Slideshow Images -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/goo.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-flex flex-column align-items-center">
                        <h1 class="text-light">Welcome to Gaming Arena</h1>
                        <p class="text-light">Play. Compete. Dominate.</p>
                        <a href="explore.php" class="btn btn-primary btn-lg mt-3">Explore Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../images/goo1.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-flex flex-column align-items-center">
                        <h1 class="text-light">Unleash the Gamer Within</h1>
                        <p class="text-dark-bold">Explore Thrilling Adventures.</p>
                        <a href="explore.php" class="btn btn-primary btn-lg mt-3">Explore Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../images/gm3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-flex flex-column align-items-center">
                        <h1 class="text-light">Challenge Accepted</h1>
                        <p class="text-light">Rise to the Top of the Leaderboard.</p>
                        <a href="explore.php" class="btn btn-primary btn-lg mt-3">Explore Now</a>
                    </div>
                </div>
            </div>
    
            <!-- Navigation Arrows -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2>About Us</h2>
                    <p>Gaming Arena is the ultimate destination for gamers to explore thrilling games and compete in an engaging environment. Choose from a wide variety of games and challenge yourself!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-dark text-light">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-dark text-light text-center">
        <p>&copy; 2024 Gaming Arena. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
