<?php

$uname1 = $_POST['uname1'];
$umail  = $_POST['umail'];
$uphone  = $_POST['uphone'];
$upswd1 = $_POST['upass1'];
$upswd2 = $_POST['upass2'];




if (!empty($uname1) || !empty($umail) || !empty($uphone) || !empty($upass1) || !empty($upass2) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "gocheeta";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}

else{
  $SELECT = "SELECT umail From register Where umail = ? Limit 1";
  $INSERT = "INSERT Into register (uname1 ,umail ,uphone,upass1, upass2 )values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $umail);
     $stmt->execute();
     $stmt->bind_result($umail);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssiss", $uname1,$umail,$uphone,$upass1,$upass2);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>