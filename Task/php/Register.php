<?php
// Establish Database connection
$mysqli = new mysqli("localhost", "root", "1234", "users_details", 3307);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

var_dump($_POST);

if (isset($_POST['username'])) {
    $username = $_POST["username"];
} else {
    echo "Username not found";
}

// Check for email in POST request
if (isset($_POST['email'])) {
    $email = $_POST["email"];
} else {
    echo "Email not found";
}

// Check for password in POST request
if (isset($_POST['password'])) {
    $password = $_POST["password"];
} else {
    echo "Password not found";
}

// Check form data
var_dump($username, $email, $password);

// Prepare and execute Insert statement
$stmt = mysqli_prepare($mysqli, "INSERT INTO registered_users(username, email, password) VALUES(?, ?, ?)");

// Bind parameters (s for string)
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

if (mysqli_stmt_execute($stmt)) {
    echo "User Registered Successfully!";
} else {
    echo "Error: " . mysqli_error($mysqli);
}

// Close statement 
mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>
