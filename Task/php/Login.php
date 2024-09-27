<?php

session_start();

header('Access-Control-Allow-Origin: *');



$mysqli = new mysqli("localhost", "root", "1234", "users_details",3307);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

  $username = $_GET['username'];
  $password = $_GET['password'];

  //$hashed_password = md5($password);
  $qry = "Select * from registered_users where email = '" . $email . "' and password = '" . $password . "'";
  $result = $conn->query($qry);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if ($count == 1) {
    $response = true;
    
  } else {
     $response = false;

   
      }

      $redis = new Redis();
    $redis->connect('localhost', 6379);

    // generate a unique session ID and store it in Redis
    $sessionId = uniqid();
    $redis->setex('session:' . $sessionId, 3600, $user['username']);
  echo json_encode($response);
  exit();