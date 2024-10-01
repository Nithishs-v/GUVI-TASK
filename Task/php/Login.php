<?php

session_start();

header('Access-Control-Allow-Origin: *');

// FreeSQL Connection details
$host = "sql12.freesqldatabase.com"; // Replace with FreeSQL hostname
$dbname = "your_database_name"; // Replace with your FreeSQL database name
$username = "your_username"; // Replace with your FreeSQL username
$password = " A2kiDhuTI6"; // Replace with your FreeSQL password
$port = 3306; // FreeSQL typically uses 3306, but adjust if different

// Connect to FreeSQL database
$mysqli = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get email and password from the request
$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';

$response = false;

if (!empty($email) && !empty($password)) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM registered_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // If the login is successful, set response to true
        $response = true;

        // Connect to Redis
        $redis = new Redis();
        $redis->connect('localhost', 6379); // Adjust if Redis is remote or uses a different configuration

        // Generate a unique session ID and store it in Redis
        $sessionId = uniqid();
        $redis->setex('session:' . $sessionId, 3600, $user['username']);
        
        // Store session ID in PHP session
        $_SESSION['session_id'] = $sessionId;
    }
    
    // Close the statement
    $stmt->close();
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
$mysqli->close();
exit();
?>
