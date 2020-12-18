<?php 
session_start();
if($_SESSION["admin"] != "true"){
  header('Location: http://localhost/GP2/HTML/login.php');
}
?>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <style>
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="./patient.php">Uninfected Corona Nurse</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" class="active">
              <a class="nav-link active" href="./patient.php">Add patient</a>
          </li>
          <li class="nav-item" class="active">
            <a class="nav-link" href="./addroom.php">Add Room</a>
          </li>
          <li class="nav-item" class="active">
            <a class="nav-link" href="./oder.php">Add Order</a>
          </li>
          <li class="nav-item" class="active">
            <a class="nav-link" style="color:red; margin-left: 900px;" href="?logout=true">Logout</a>
          </li>
        </ul>    
      </div>
    </nav>
    <?php
    if(isset($_GET['logout'])){
      sendCode();
    }
    function sendCode(){
      $_SESSION["admin"] = "false";
      session_destroy();
      header('Location: http://localhost/GP2/HTML/login.php');
    }
    ?>
    <div class="border border-light p-3 mb-4">
      <div class="d-flex align-items-center justify-content-center" style="height: 500px;"> 
        <form action="patient.php" method="post">
          <div class="form-group">
            <h1 class="font-italic text-center">Add patient</h1><br>
            <input 
              name="name"
              id="name"
              type="text" 
              class="form-control"
              required 
              placeholder="Name">
            <br>
            <input 
              name="email"
              id="email"
              type="email" 
              class="form-control"
              required  
              placeholder="E-mail">
            <br>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input 
                  type="date" 
                  name="birthday"
                  id="birthday"
                  placeholder="Birthday" 
                  class="form-control" 
                  required>
              </div>
              <div class="form-group col-md-4">
                <select 
                  id="inputState" 
                  name="gender"
                  class="form-control" 
                  required> 
                  <option value="" selected disabled>Gender</option>
                  <option>male</option>
                  <option>Female</option>
                </select>
              </div>
              <input 
                type="password"
                name="password"
                id="password"
                required 
                class="form-control" 
                placeholder="password">
              <br>
              <br>  
              <input 
                type="password" 
                name="rePassword"
                id="repassword"
                required
                class="form-control" 
                placeholder="re-password">
              <br>
              <br> 
              <input 
                type="text" 
                name="username"
                id="username"
                required
                class="form-control" 
                placeholder="Username">
              <br>
              <br>
              <button 
                type="submit"
                class="btn btn-primary btn-lg btn-block"
                >Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body> 
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
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
    if($nameErr == ""  && $emailErr == "" && $dateErr == "" && $genderErr == "" && $usernameErr == "" && $passwordErr == "" ){
      if ($password !== $repassword)
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: 'The passwords do not match',
          confirmButtonText: `Try again`,
        }).then(function() {
          document.getElementByID('rePassword').value = '';
          document.getElementByID('password').value = '';
      });
        </script>
        ";
      else {
        $conn = OpenCon();
        $password =  sha1($password);

        $sql1 = ("INSERT INTO patients (`Name` , `Birthdate` , `E-mail` , `Username` , `Gender` , `Password`)
          VALUES ('$name','$date' , '$email' , '$username' , '$gender' , '$password')");

        if ($conn->query($sql1) === TRUE) {
          echo "SQL1 New record created successfully";
          header('Location: http://localhost/GP2/HTML/signup.php');
        } else {
          echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
        CloseCon($conn);
      }
    }
    else {
      if($nameErr != ""){
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: `$nameErr`,
          confirmButtonText: `Try again`,
        }).then(function() {
          document.getElementByID('name').value = '';
      });
        </script>
        ";
      }
      else if($emailErr != ""){
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: `$emailErr`,
          confirmButtonText: `Try again`,
        }).then(function() {
          document.getElementByID('email').value = '';
      });
        </script>
        ";
      }
      else if($passwordErr != ""){
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: `$passwordErr`,
          confirmButtonText: `Try again`,
        }).then(function() {
          document.getElementByID('rePassword').value = '';
          document.getElementByID('password').value = '';
      });
        </script>
        ";
      }
      else if($usernameErr != ""){
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: `$usernameErr`,
          confirmButtonText: `Try again`,
        }).then(function() {
          document.getElementByID('username').value = '';
      });
        </script>
        ";
      }
      else if($usernameErr != ""){
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Something Wrong',
          confirmButtonText: `Try again`,
        })
        </script>
        ";
      }
    }
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