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
        <title>Add Order</title>
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
                    <a class="nav-link" href="./patient.php">Add patient</a>
                </li>
                <li class="nav-item" class="active">
                  <a class="nav-link" href="./addroom.php">Add Room</a>
                </li>
                <li class="nav-item" class="active">
                  <a class="nav-link active" href="./oder.php">Add Order</a>
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
                <form action="/GP2/php/order.php" method="post">
                    <div class="form-group"s>
                        <h1 class="font-italic text-center">Add Orders</h1>
                        <div class="form-group">
                            <select 
                                id="inputState" 
                                name="roomID"
                                class="form-control" 
                                required> 
                                <option value="" selected disabled>ROOM ID</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                          </select>
                          <br>
                        <button 
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                        >Add Order</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
    </body>
</html>