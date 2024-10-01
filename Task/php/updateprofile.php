<?php

header('Access-Control-Allow-Origin: *');

require '../vendor/autoload.php';

    $client = new MongoDB\Client("mongodb://localhost:27017");

    $profiledb = $client -> profiledb;

    $userCollection = $profiledb -> usersProfile;   

    $updateResult = $userCollection->updateOne(
        [ 'username' => $_GET["username"] ],
        [ '$set' => [ 
            'firstname' => $_GET["firstname"],
            'lastname' => $_GET["lastname"],
            'password' => $_GET["password"],
            'email' => $_GET["email"],
            'phoneNumber' => $_GET["phoneNumber"],
            'dob' => $_GET["dob"],
         ]]
    );

    $data = $userCollection->find(["username"=>$_GET["username"]]);

    foreach($data as $dt)
    {
    $profile=[
        "username"=>$dt["username"],
        "password"=>$dt["password"],
        "email"=>$dt["email"],
        "phoneNumber"=>$dt["phoneNumber"],
        "firstname"=>$dt["firstname"],
        "lastname"=>$dt["lastname"],
        "dob"=>$dt["dob"],
    ];
    header('Content-type: application/json');
    echo json_encode($profile);
    break;
    }

?>
