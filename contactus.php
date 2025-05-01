<?php
$host = "localhost";         
$username = "root";          
$password = "";              
$database = "users";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO contact_queries (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you, $name! Your message has been successfully submitted.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
