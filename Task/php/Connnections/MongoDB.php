<?php
$mongodbLink = "mongodb+srv://nithishsv21cse:Nithish%4020@cluster0.hn1u8cy.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";
$mongodbDatabase  = "Guvi";
$mongodbCollection = "task";

$mongo = new MongoDB\Driver\Manager($mongodbLink);
?>
