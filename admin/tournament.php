<?php
// Database connection (adjust credentials as needed)
$servername = "localhost";
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "gaming_arena"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch game details
$sql = "SELECT title, category, price_per_hour, image_path FROM games";
$result = $conn->query($sql);
?>

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
        body {
            background-color: #1f1f1f;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .game-card {
            background-color: #292929;
            color: white;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .game-card img {
            border-radius: 10px 10px 0 0;
            max-height: 200px;
            object-fit: cover;
        }

        .game-card:hover {
            transform: scale(1.05);
        }

        .timer {
            font-size: 2rem;
            color: #ffd700;
            margin-top: 10px;
            display: none;
        }

        .timer-form input {
            width: 70px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
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

    <!-- Header -->
    <header>

    </header>

    <!-- Game Cards Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Play Ground</h2>
            <div class="row g-4">
                <?php
                if ($result->num_rows > 0) {
                    // Output each game as a card
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col-md-6 col-lg-4">
                            <div class="card game-card" id="game_' . $row['title'] . '">
                                <img src="' . $row['image_path'] . '" class="card-img-top" alt="' . $row['title'] . '">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $row['title'] . '</h5>
                                    <p><span class="badge">' . $row['category'] . '</span></p>
                                    <p class="card-text">Price: $' . $row['price_per_hour'] . '/hour</p>
                                    <button class="btn btn-warning btn-sm mt-3" onclick="showTimerForm(\'' . $row['title'] . '\', ' . $row['price_per_hour'] . ')">Play</button>
                                    <!-- Timer Form -->
                                    <div class="timer-form" id="timerForm_' . $row['title'] . '" style="display:none;">
                                        <input type="number" class="form-control d-inline" id="hours_' . $row['title'] . '" placeholder="Hours" min="0" required>
                                        <input type="number" class="form-control d-inline" id="minutes_' . $row['title'] . '" placeholder="Minutes" min="0" max="59" required>
                                        <button class="btn btn-primary mt-2" onclick="startTimer(\'' . $row['title'] . '\')">Start Timer</button>
                                        <button class="btn btn-danger mt-2" onclick="cancelTimer(\'' . $row['title'] . '\')">Cancel</button>
                                    </div>
                                    <!-- Timer Countdown -->
                                    <div id="timer_' . $row['title'] . '" class="timer"></div>
                                    <!-- Record Game Button -->
                                    <a href="record.php?game=' . urlencode($row['title']) . '" class="btn btn-success mt-3" id="recordGameBtn_' . $row['title'] . '" style="display:none;">Record Game</a>
                                    <!-- Amount to be Paid -->
                                    <p id="amount_' . $row['title'] . '" style="display:none;">Amount: $<span id="amount_value_' . $row['title'] . '"></span></p>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p>No games found.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let timerIntervals = {}; // Object to store interval references for multiple games
        let gamePrices = {}; // Store prices for each game

        function showTimerForm(gameTitle, price) {
            gamePrices[gameTitle] = price;
            document.getElementById('timerForm_' + gameTitle).style.display = 'block';
        }

        function startTimer(gameTitle) {
            const hours = parseInt(document.getElementById('hours_' + gameTitle).value) || 0;
            const minutes = parseInt(document.getElementById('minutes_' + gameTitle).value) || 0;
            const totalSeconds = (hours * 3600) + (minutes * 60);

            if (totalSeconds > 0) {
                let remainingSeconds = totalSeconds;
                const timerElement = document.getElementById('timer_' + gameTitle);
                const recordButton = document.getElementById('recordGameBtn_' + gameTitle);
                const amountElement = document.getElementById('amount_' + gameTitle);
                const amountValueElement = document.getElementById('amount_value_' + gameTitle);

                timerElement.style.display = 'block';

                // Clear any previous intervals for this game
                if (timerIntervals[gameTitle]) {
                    clearInterval(timerIntervals[gameTitle]);
                }

                timerIntervals[gameTitle] = setInterval(() => {
                    const hrs = Math.floor(remainingSeconds / 3600);
                    const mins = Math.floor((remainingSeconds % 3600) / 60);
                    const secs = remainingSeconds % 60;

                    timerElement.textContent = `${hrs}:${mins < 10 ? '0' + mins : mins}:${secs < 10 ? '0' + secs : secs}`;
                    if (remainingSeconds === 0) {
                        clearInterval(timerIntervals[gameTitle]);
                        timerIntervals[gameTitle] = null;
                        recordButton.style.display = 'block';

                        // Calculate the amount to be paid based on time played
                        const totalMinutesPlayed = (totalSeconds - remainingSeconds) / 60;
                        const amountToPay = (totalMinutesPlayed / 60) * gamePrices[gameTitle];
                        amountValueElement.textContent = amountToPay.toFixed(2);
                        amountElement.style.display = 'block';
                    }

                    remainingSeconds--;
                }, 1000);
            }
        }

        function cancelTimer(gameTitle) {
            if (timerIntervals[gameTitle]) {
                clearInterval(timerIntervals[gameTitle]);
                timerIntervals[gameTitle] = null;
            }
            document.getElementById('timerForm_' + gameTitle).style.display = 'none';
            document.getElementById('timer_' + gameTitle).style.display = 'none';
            document.getElementById('recordGameBtn_' + gameTitle).style.display = 'none';
            document.getElementById('amount_' + gameTitle).style.display = 'none';
        }
    </script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
