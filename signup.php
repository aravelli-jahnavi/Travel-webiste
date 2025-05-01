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
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $fullname = $conn->real_escape_string($fullname);
    $email = $conn->real_escape_string($email);
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$user', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. Welcome, $fullname!";
        // Redirect to login page
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
