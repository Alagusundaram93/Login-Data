<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    
    // Check for duplicate username or email
    $duplicateCheckSql = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($duplicateCheckSql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or email is already taken');</script>";
    } else {
        // SQL query to insert data into the users table
        $insertSql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("sss", $username, $email, $password); // Store the plaintext password

        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Registration successful!');</script>";
            // Redirect to the login page
            header("Location: login.html");
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
