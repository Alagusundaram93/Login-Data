<?php
session_start();
 // Start the session to manage tokens

// Function to generate a random token
function generateCSRFToken() {
    return $_SESSION["token"]; // Generate a 32-byte random token
}

// Function to validate the token
function validate_token($token) {
    return isset($_SESSION['token']) && $_SESSION['token'] === $token;
}

// Include your database connection
include "index.php";

// Check if the token is valid and if 'id' is set in the GET request
if(isset($_GET['id']) && isset($_GET['token']) && validate_token($_GET['token'])) {
    $user_id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `crud` WHERE `id`=?");
    $stmt->bind_param("i", $user_id); // Assuming 'id' is an integer
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

// Generate a new token after each successful request or when starting a new session
$_SESSION['token'] = generateCSRFtoken();
?>
