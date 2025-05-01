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

// Fetch users from the database
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);


$bookings_sql = "SELECT * FROM bookings";
$bookings_result = $conn->query($bookings_sql);

?>

<?php include 'dashboard.html'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pass PHP data to JavaScript variables
        var users = <?php echo json_encode($users_result->fetch_all(MYSQLI_ASSOC)); ?>;
        var bookings = <?php echo json_encode($bookings_result->fetch_all(MYSQLI_ASSOC)); ?>;

        console.log('Users:', users);
        console.log('Bookings:', bookings);

        // Populate the Users table
        var usersList = document.getElementById('users-list');
        users.forEach(function(user) {
            var row = document.createElement('tr');
            row.innerHTML = `<td>${user.id}</td><td>${user.fullname}</td><td>${user.email}</td><td>${user.username}</td>`;
            usersList.appendChild(row);
        });

        // Populate the Bookings table
        var bookingsList = document.getElementById('bookings-list');
        bookings.forEach(function(booking) {
            var row = document.createElement('tr');
            row.innerHTML = `<td>${booking.id}</td><td>${booking.package}</td><td>${booking.name}</td><td>${booking.phone}</td><td>${booking.booked_at}</td>`;
            bookingsList.appendChild(row);
        });
    });
</script>

<?php
// Close connection
$conn->close();
?>
