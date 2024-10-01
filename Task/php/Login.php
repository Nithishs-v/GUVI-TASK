<?php

session_start();

header('Access-Control-Allow-Origin: *');

// FreeSQL Connection details
$host = "sql12.freesqldatabase.com"; 
$dbname = "sql12734604";
$username = "sql12734604"; 
$password = " A2kiDhuTI6";
$port = 3306; 

// Connect to FreeSQL database
$mysqli = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

$response = false;

if (!empty($username) && !empty($password)) {
    // Prepare the SQL stateme
    $stmt = $mysqli->prepare("SELECT * FROM Login WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // If the login is successful, set response to true
        $response = true;

        // Connect to Redis
        $redis = new Redis();
        $redis->connect('localhost', 6379); 

    
        $sessionId = uniqid();
        $redis->setex('session:' . $sessionId, 3600, $user['username']);
        
    
        $_SESSION['session_id'] = $sessionId;
    }
    
    // Close the statement
    $stmt->close();
}

echo json_encode($response);

$mysqli->close();
exit();
?>
