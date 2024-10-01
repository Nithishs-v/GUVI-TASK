<?php
// FreeSQL connection details
$host = "sql12.freesqldatabase.com"; 
$dbname = "sql12734604";
$username = "sql12734604"; 
$password = "A2kiDhuTI6"; 
$port = 3306; 

// Establish Database connection
$mysqli = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check and fetch the POST request data
if (isset($_POST['username'])) {
    $username = $_POST["username"];
} else {
    die("Username not found");
}

if (isset($_POST['email'])) {
    $email = $_POST["email"];
} else {
    die("Email not found");
}

if (isset($_POST['password'])) {
    $password = $_POST["password"];
} else {
    die("Password not found");
}



// Prepare and execute Insert statement using prepared statements
$stmt = $mysqli->prepare("INSERT INTO register(username, email, password) VALUES(?, ?, ?)");

if ($stmt) {
    // Bind parameters (s for string)
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User Registered Successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error in preparing statement: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
