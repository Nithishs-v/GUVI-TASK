<?php

$name = $_POST['username'];
$mobile  = $_POST['mobile'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$email = $_POST['email'];



if (!empty($email) || !empty($upswd1)  )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "guvi_db";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else if($upswd1 != $upswd2)
{
  echo "Password and Confirm-password are dismatched..!";
}
else if($upswd1 == $upswd2){

  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register ( username, mobile, dob,age,email)values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssisi",$email,$upswd1,$name,$age,$dob,$phno);
      $stmt->execute();
      }

// sending information in Mangodb database
    //   $c->insertOne(["Name" => $name,
    //                  "email" => $email,
    //                  "password" => $upswd1,
    //                  "Age" => $age, 
    //                  "DOB" => $dob, 
    //                  "Phone_number" => $phno]
    //               );

    //   echo "<script> New record inserted sucessfully </script>";

    //  }
    // else 
    // {
    //   echo "Someone already register using this email";
    //  }
     $stmt->close();
     $conn->close(); 
    }
}
else 
{
 echo "All field are required";
 die();
}

?>