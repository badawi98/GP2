<?php
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["username"])) {
        $username = test_input($_POST["username"]);
      }
    
      if (!empty($_POST["password"])) {
        $password = test_input($_POST["password"]);
      }
}

if($username != "" && $password != ""){
    $conn = OpenCon();
    $sql = "select * from `admin`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();
            if ($row["Username"] == $username && $row["Password"] == sha1($password)) {
                header('Location: http://localhost/GP2/HTML/signup.php');
                setSession();
                    break;
            }

        }
    }
    CloseCon($conn);
}
function setSession(){
  session_start();
  $_SESSION["admin"] = "true";
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
function OpenCon()
{
  $dbhost = "remotemysql.com";
  $dbuser = "Fg7RTbtnbK";
  $dbpass = "wzkdvOtlru";
  $db = "Fg7RTbtnbK";

   $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die('Could not connect to MySQL: ' .mysqli_connect_error());
   return $conn;
  }
 
function CloseCon($conn)
{
  $conn -> close();
}
?>