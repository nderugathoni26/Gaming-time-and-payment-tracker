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

// Insert record into the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $player_name = $_POST['player_name'];
    $game_name = $_POST['game_name'];
    $hours_played = $_POST['hours_played'];
    $date_played = $_POST['date_played'];
    $amount_paid = $_POST['amount_paid'];

    $sql = "INSERT INTO game_records (player_name, game_name, hours_played, date_played, amount_paid) 
            VALUES ('$player_name', '$game_name', '$hours_played', '$date_played', '$amount_paid')";

    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
}

// Delete record functionality
if (isset($_GET['delete'])) {
    $record_id = $_GET['delete'];

    // Delete query
    $delete_query = "DELETE FROM game_records WHERE id = $record_id";

    if ($conn->query($delete_query)) {
        echo "Record deleted successfully!";
        // Redirect to the same page to refresh the table
        header("Location: record.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all records for display
$search_query = "";
if (!empty($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql = "SELECT * FROM game_records WHERE game_name LIKE '%$search_query%' OR date_played LIKE '%$search_query%' ORDER BY date_played DESC";
} else {
    $sql = "SELECT * FROM game_records ORDER BY date_played DESC";
}
$result = $conn->query($sql);

// Calculate totals
$total_hours = 0;
$total_amount = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_hours += $row['hours_played'];
        $total_amount += $row['amount_paid'];
    }
    // Reset the pointer for the loop below
    $result->data_seek(0);
}

// Generate receipt (based on row selected)
if (isset($_GET['generate_receipt'])) {
    $record_id = $_GET['generate_receipt'];

    $receipt_query = "SELECT * FROM game_records WHERE id = $record_id";
    $receipt_result = $conn->query($receipt_query);
    $receipt_row = $receipt_result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Game - Gaming Arena</title>
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

        .form-container {
            background-color: #292929;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .search-bar {
            margin-bottom: 15px;
        }

        .search-bar input {
            background-color: #333;
            color: white;
        }

        .btn-primary, .btn-danger {
            border-radius: 20px;
        }

        .receipt {
            background-color: white;
            color: black;
            padding: 10px; /* Reduced padding */
            margin-top: 20px;
            border-radius: 10px;
            width: 300px; /* Set a fixed width for the receipt */
            max-width: 100%;
        }

        .receipt h4 {
            margin-bottom: 10px; /* Reduced margin */
            font-size: 1.2rem;  /* Smaller font size */
        }

        .receipt p {
            font-size: 0.9rem; /* Reduced font size for details */
            margin-bottom: 5px; /* Reduced space between paragraphs */
        }

        .close-receipt-btn {
            margin-top: 10px;
            cursor: pointer;
            color: #f44336;
            font-size: 0.9rem; /* Smaller font size for the close button */
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
                    <li class="nav-item"><a class="nav-link" href="../Main/index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="AdDashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="games.php">Add Games</a></li>
                    <li class="nav-item"><a class="nav-link" href="viewgames.php">View Added Games</a></li>
                    <li class="nav-item"><a class="nav-link" href="tournament.php">GAMES..!</a></li>
                    <li class="nav-item"><a class="nav-link" href="record.php">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="Adlogin.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
    </header>

    <!-- Record Game Form -->
    <section class="py-4">
        <div class="container form-container">
            <h3 class="mb-3">Record Game Details</h3>
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="player_name" class="form-control" placeholder="Player Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="game_name" class="form-control" placeholder="Game Name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="number" name="hours_played" class="form-control" placeholder="Hours Played" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date_played" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="amount_paid" class="form-control" placeholder="Amount Paid" min="0" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save Record</button>
            </form>
        </div>
    </section>

    <!-- Search and Records Table -->
    <section class="table-container container">
        <div class="search-bar">
            <input type="text" id="search" class="form-control" placeholder="Search by Game Name or Date (YYYY-MM-DD)" value="<?= htmlspecialchars($search_query); ?>" onkeyup="searchRecords()">
        </div>

        <table class="table table-dark table-striped" id="recordsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Player Name</th>
                    <th>Game Name</th>
                    <th>Hours Played</th>
                    <th>Date Played</th>
                    <th>Amount Paid</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['player_name'] . "</td>";
                        echo "<td>" . $row['game_name'] . "</td>";
                        echo "<td>" . $row['hours_played'] . "</td>";
                        echo "<td>" . $row['date_played'] . "</td>";
                        echo "<td>" . $row['amount_paid'] . "</td>";
                        echo "<td>
                            <a href='record.php?generate_receipt=" . $row['id'] . "' class='btn btn-danger btn-sm'>Generate Receipt</a>
                            <a href='record.php?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No records found.</td></tr>";
                } ?>
            </tbody>
        </table>
        <div class="total-info">
            <h4>Total Hours Played: <?= $total_hours; ?> hrs</h4>
            <h4>Total Amount Paid: <?= $total_amount; ?> KES</h4>
        </div>
    </section>

    <!-- Receipt Section -->
    <?php if (isset($receipt_row)): ?>
        <section class="container">
            <div class="receipt">
                <h4>Receipt</h4>
                <p><strong>Player:</strong> <?= $receipt_row['player_name']; ?></p>
                <p><strong>Game:</strong> <?= $receipt_row['game_name']; ?></p>
                <p><strong>Hours Played:</strong> <?= $receipt_row['hours_played']; ?> hrs</p>
                <p><strong>Date:</strong> <?= $receipt_row['date_played']; ?></p>
                <p><strong>Amount Paid:</strong> <?= $receipt_row['amount_paid']; ?> KES</p>
                <button class="close-receipt-btn" onclick="window.location.href='record.php'">Close Receipt</button>
                <button class="btn btn-secondary" onclick="printReceipt()">Print Receipt</button>
            </div>
        </section>
    <?php endif; ?>

    <script>
        function searchRecords() {
            const searchTerm = document.getElementById("search").value;
            window.location.href = "record.php?search=" + searchTerm;
        }

        function printReceipt() {
            const receiptContent = document.querySelector('.receipt').innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Receipt</title></head><body>');
            printWindow.document.write(receiptContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
