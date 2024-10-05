<?php

header('Access-Control-Allow-Origin: *');

require './Connections/MongoDB.php"';

   // $client = new MongoDB\Client("mongodb://localhost:27017");

    $profiledb = $client -> profiledb;

    $userCollection = $profiledb -> usersProfile;   

    $updateResult = $userCollection->updateOne(
        [ 'name' => $_GET["name"] ],
        [ '$set' => [ 
            'mobile' => $_GET["mobile"],
            'dob' => $_GET["dob"],
            'age' => $_GET["age"],
            'email' => $_GET["email"],
            
         ]]
    );

    $data = $userCollection->find(["username"=>$_GET["username"]]);

    foreach($data as $dt)
    {
    $profile=[
        "name"=>$dt["name"],
        "mobile"=>$dt["mobile"],
        "dob"=>$dt["dob"],
        "age"=>$dt["age"],
        "email"=>$dt["email"],
        
    ];
    header('Content-type: application/json');
    echo json_encode($profile);
    break;
    }

?>
