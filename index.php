<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker System</title>
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    background-image: url('image/money1.jpg');
        background-size: cover;
        background-position: center;
        height: 500px; /* Adjust height as needed */
    
}
/* Navigation Bar */
nav {
    background: linear-gradient(90deg, #4CAF50, #34a4d7);
    color: white;
    padding: 0.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

nav ul {
    display: flex;
    justify-content: center;
    list-style: none;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #f9d423;
}

/* Content Section */
#content {
    text-align: center;
    margin: 50px auto;
    padding: 20px;
    max-width: 800px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#content h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #4CAF50;
}

#content p {
    font-size: 1.2rem;
    color: #555;
}

/* Footer */
footer {
    text-align: center;
    background: linear-gradient(90deg, #4CAF50, #34a4d7);
    color: white;
    padding: 10px 0;
    position: relative;
    bottom: 10;
    margin-top: 500px;
    width: 100%;
}

footer p {
    font-size: 0.9rem;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    nav ul {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    nav ul li {
        margin: 10px 0;
    }

    #content {
        margin: 20px;
        padding: 15px;
    }

    #content h1 {
        font-size: 2rem;
    }

    #content p {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="registration.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <!-- <li><a href="logout.php">Logout</a></li> -->
        </ul>
    </nav>

    <!-- Placeholder for individual page content -->
    <div id="content">
        <?php
        // Include database connection
        include('db.php');

        // Placeholder content based on the current page
        if (basename($_SERVER['PHP_SELF']) == 'index.php') {
            echo '<h1>Welcome to Budget Tracker System</h1>';
            echo '<p>Manage your expenses efficiently with our simple and intuitive system.</p>';
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Budget Tracker System. All Rights Reserved.</p>
    </footer>
</body>
</html>
