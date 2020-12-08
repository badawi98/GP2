<?php   
$name = $email = $gender = $username = $password = $date = $repassword = "";
$nameErr = $emailErr = $genderErr = $usernameErr = $passwordErr = $dateErr = $repasswordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["birthday"])) {
    $dateErr = "birthday is required";
  } else {
    $date = test_input($_POST["birthday"]);
  }

  if (empty($_POST["rePassword"])) {
    $repasswordErr = "birthday is required";
  } else {
    $repassword = test_input($_POST["rePassword"]);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $usernameErr = "UserName is required";
    } else {
      $username = test_input($_POST["username"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
        $usernameErr = "Only letters and white space allowed";
      }
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
    } else {
      $password = test_input($_POST["password"]);
      // check if name only contains letters and whitespace
      $uppercase = preg_match('@[A-Z]@', $password);
      $lowercase = preg_match('@[a-z]@', $password);
      $number    = preg_match('@[0-9]@', $password);
      $specialChars = preg_match('@[^\w]@', $password);
      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $passwordErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      }     
      }
    }
  }
if($nameErr == ""  && $emailErr == "" && $dateErr == "" && $genderErr == "" && $usernameErr == "" && $passwordErr == "" ){
  $conn = OpenCon();
  $password =  sha1($password);

  $sql1 = ("INSERT INTO Users (`Name` , `Birthdate` , `E-mail` , `Username` , `Gender`)
  VALUES ('$name','$date' , '$email' , '$username' , '$gender')");

  $sql2 = ("INSERT INTO Passwords (`Username`,`Password`)
  VALUES ('$username','$password')");

  if ($conn->query($sql1) === TRUE) {
    echo "SQL1 New record created successfully";
  } else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
  }
  if ($conn->query($sql2) === TRUE) {
    echo "SQL2 New record created successfully";
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
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
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $db = "GP2";
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die('Could not connect to MySQL: ' .mysqli_connect_error());
   return $conn;
  }
 
function CloseCon($conn)
{
  $conn -> close();
}
?>