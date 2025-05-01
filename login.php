<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = "";     // Your database password
$dbname = "users";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // Check if the user exists in the database
    $checkUserQuery = "SELECT * FROM users WHERE username='$user' OR email='$user'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // Password is correct, start session and redirect
            session_start();
            $_SESSION['user'] = $row['username'];
            header("Location: pro.html");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with that username or email. Please try again.";
    }
}

// Close connection
$conn->close();
?>
