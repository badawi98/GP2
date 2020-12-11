<?php
$roomID = "";
$delivered  = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["roomID"])) {
        $roomID = test_input($_POST["roomID"]);
      }
    
}

if($roomID != ""){
    $firstDigit = rand(1 , 9);
    $secondDigit = rand(1 , 9) * 10 ;
    $thirdDigit = rand(1 , 9) * 100;
    $fourthDigit = rand(1 , 9) * 1000;
    $OrderId = $firstDigit + $secondDigit + $thirdDigit + $fourthDigit;
    echo "test";
    $conn = OpenCon();
    echo "coo";
    $sql1 = ("INSERT INTO `order` (`Room ID` , `Order ID` , `Delivered`)
    VALUES ('$roomID','$OrderId' ,'$delivered' )");
    if ($conn->query($sql1) === TRUE) {
        echo "SQL1 New record created successfully";
      } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
      }
    CloseCon($conn);
}



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
function OpenCon()
{
  $dbhost = "sql7.freemysqlhosting.net";
  $dbuser = "sql7381534";
  $dbpass = "qL8C2fVrY1";
  $db = "sql7381534";

   
   $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die('Could not connect to MySQL: ' .mysqli_connect_error());
   return $conn;
  }
 
function CloseCon($conn)
{
  $conn -> close();
}
?>