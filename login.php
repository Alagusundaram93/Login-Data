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

// function validateCSRFToken($token) {
//     return isset($_SESSION['token']) && hash_equals($_SESSION['token'], $token);
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if (!isset($_POST['token']) || !validateCSRFToken($_POST['token'])) {
    //     die("Invalid CSRF token");
    // }
    // Sanitize and get form data
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    // Check if the user exists and the password matches
    $sql = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();


        if ($password === $user['password']) {
            // Log the successful login attempt
            $logSql = "INSERT INTO logins (username) VALUES (?)";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param("s", $username);
            $logStmt->execute();
            $logStmt->close();

            echo "<script>alert('Login successful!');</script>";
            // Redirect to a welcome page or dashboard
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
            // header("Location: login.html");
        }
    } else {
        echo "<script>alert('User not found');</script>";
        // header("Location: login.html");
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
