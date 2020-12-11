<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    <style>
    </style>
  </head>
  <body>
    <div 
    class="border border-light p-3 mb-4">
    <div 
      class="d-flex align-items-center justify-content-center" 
      style="height: 500px;">    
      <form action="login.php" method="post">  
        <div class="form-group">
          <h1 
            class="font-italic" 
            class="text-center">LogIn</h1>
          <br>
          <input 
            type="text" 
            class="form-control" 
            required
            name="username"
            placeholder="Username">
          <br>
          <input 
            type="password" 
            class="form-control" 
            id="pass" 
            required
            name="password"
            placeholder="password">
          <br>
          
          <button 
            type="submit"
              [disabled]="!postForm.valid"
            class="btn btn-primary btn-lg btn-block"
            >Login</button>
          <br>
          <br>
        </div>
        </form>   
    </div>
  </div>  
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
              echo "
              <script>
              Swal.fire({
                icon: 'success',
                title: 'Logged in Successfully',
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                window.location = 'patient.php';
            });
              </script>
              ";
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
