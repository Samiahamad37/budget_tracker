<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind the email parameter as a string
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Fetch the user record as an associative array

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id']; // Set session variable for user ID
        header('Location: dashboard.php'); // Redirect to dashboard
        exit();
    } else {
        $error = "Invalid username or password";
        echo $error; // Display error message
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h1>Login</h1>
    <form method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <footer>
        <p>&copy; 2024 Budget Tracker System. All Rights Reserved.</p>
    </footer>
</body>
</html>
