<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$package = $_POST['selected_package'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "INSERT INTO bookings (package, name, email, phone)
        VALUES ('$package', '$name', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Booking Confirmed!</h2><p>Thank you, $name. Your booking for '$package' is confirmed.</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
