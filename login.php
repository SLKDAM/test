<?php
session_start(); // Start the session

// Database connection
$conn = new mysqli("localhost", "root", "", "user_management");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Retrieve user from database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Successful login
        $_SESSION['username'] = $user['username'];
        header("Location: userdashboard.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Invalid password!";
    }
} else {
    echo "No user found with this email!";
}

$conn->close();
?>
