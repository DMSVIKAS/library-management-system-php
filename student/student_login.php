<?php
include "connection.php";


if(isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($db, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : '';

    if(empty($username) || empty($password)) {
        echo '<div class="alert alert-danger" role="alert">Please fill all fields</div>';
    } else {
        $query = "SELECT * FROM `student` WHERE `username`='$username'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
                // Password is correct, redirect to index.php
                header("Location: index.php");
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">Incorrect password</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">User not found</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style type="text/css">
        section {
            margin-top: -20px;
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand active">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="student_login.php">HOME</a></li>
            <li><a href="">BOOKS</a></li>
            <li><a href="">FEEDBACK</a></li>
          </ul>
          <?php
            if(isset($_SESSION['login_user']))
            {?>

                <ul class="nav navbar-nav navbar-right">
                  <li><a href="">
                    <div style="color: white">
                      <?php
                        echo "Welcome ".$_SESSION['login_user']; 
                      ?>
                    </div>
                  </a></li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                </ul>
              <?php
            }
            else
            {   ?>
              <ul class="nav navbar-nav navbar-right">

                <li><a href="student_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                
                <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
              </ul>
                <?php
            }
          ?>

          

      </div>
    </nav>
    <section>
        <div class="log_img">
            <br>
            <div class="box1">
                <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;">Library Management System</h1>
                <h1 style="text-align: center; font-size: 25px;">User Login Form</h1><br>
                <form  name="login" action="" method="POST">
                    <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
                        <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px"> 
                    </div>
                </form>
                <p style="color: white; padding-left: 15px;">
                    <br><br>
                    <a style="color:white;" href="student_reset.php">Forgot password?</a> &nbsp &nbsp &nbsp &nbsp 
                    New to this website?<a style="color: white;" href="registration.php">Sign Up</a>
                </p>
            </div>
        </div>
    </section>
</body>
</html>
