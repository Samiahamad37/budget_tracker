<?php
session_start(); // Start the session
include('db.php'); // Ensure this file establishes a proper $conn connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match. Please try again.";
        echo $error;
        exit;
    }

    // Check if email already exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        echo "Error preparing query: " . $conn->error;
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "An account with this email already exists. Please log in.";
        echo $error;
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo "Error preparing query: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful. Please <a href='login.php'>log in</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="registration.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Logout</a></li>
    </ul>
</nav>
<h1>Register</h1>
<form action="" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <button type="submit">Register</button>
</form>
<footer>
    <p>&copy; 2024 Budget Tracker System. All Rights Reserved.</p>
</footer>
</body>
</html>
