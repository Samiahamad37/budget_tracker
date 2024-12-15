<?php
session_start(); // Start the session
include 'db.php'; // Include the database connection

// Authentication check
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO transactions (date, category, amount, type) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssds", $date, $category, $amount, $type);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

// // Fetch transactions
// $result = $conn->query("SELECT * FROM transactions");

// // Calculate summary
// $total_income = $conn->query("SELECT SUM(amount) AS total FROM transactions WHERE type = 'Income'")->fetch_assoc()['total'] ?? 0;
// $total_expense = $conn->query("SELECT SUM(amount) AS total FROM transactions WHERE type = 'Expense'")->fetch_assoc()['total'] ?? 0;
// $balance = $total_income - $total_expense;
// ?>
// log

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO transactions (date, category, amount, type, user_id) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssdsi", $date, $category, $amount, $type, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

// Fetch transactions for the logged-in user
$stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

// Calculate summary for the logged-in user
$stmt = $conn->prepare("SELECT SUM(amount) AS total FROM transactions WHERE type = 'Income' AND user_id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$total_income = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

$stmt = $conn->prepare("SELECT SUM(amount) AS total FROM transactions WHERE type = 'Expense' AND user_id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$total_expense = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

$balance = $total_income - $total_expense;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Budget Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="">
    <style>
 nav {
    background: linear-gradient(90deg, #4CAF50, #34a4d7);
    color: white;
    padding: 0.5rem 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}

nav ul {
    display: flex; /* Align items in a single row */
    justify-content: space-between; /* Add space between items */
    align-items: center; /* Vertically center items */
    list-style: none; /* Remove default list styling */
    margin: 0;
    padding: 0;
}

nav ul li {
    margin: 0;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    padding: 0.5rem 1rem; /* Add padding around links for better spacing */
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #f9d423;
}
footer {
    text-align: center;
    background: linear-gradient(90deg, #4CAF50, #34a4d7);
    color: white;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer p {
    font-size: 0.9rem;
}
  
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="registration.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Personal Budget Tracker</h1>

        <!-- Form for Adding Transactions -->
        <div class="card my-4">
            <div class="card-header">Add a New Transaction</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control" placeholder="e.g., Food, Rent or deposit" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Transaction</button>
                </form>
            </div>
        </div>

        <!-- Summary -->
        <div class="card my-4">
            <div class="card-header">Summary</div>
            <div class="card-body">
                <p><strong>Total Income:</strong> $<?= number_format($total_income, 2) ?></p>
                <p><strong>Total Expenses:</strong> $<?= number_format($total_expense, 2) ?></p>
                <p><strong>Balance:</strong> $<?= number_format($balance, 2) ?></p>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="card my-4">
            <div class="card-header">Transactions</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['date']) ?></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td>$<?= number_format($row['amount'], 2) ?></td>
                                <td><?= htmlspecialchars($row['type']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Budget Tracker System. All Rights Reserved.</p>
    </footer>
</body>
</html>
