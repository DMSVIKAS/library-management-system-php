<?php
include "connection.php";

$error = ""; // Initialize error message

if(isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $firstname = mysqli_real_escape_string($db, $_POST['first']);
    $lastname = mysqli_real_escape_string($db, $_POST['last']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);

    // Check if username already exists
    $check_query = "SELECT * FROM `admin` WHERE `username` = '$username'";
    $check_result = mysqli_query($db, $check_query);
    if(mysqli_num_rows($check_result) > 0) {
        $error = "Username already exists";
    } elseif(strlen($_POST['password']) < 8) {
        $error = "Password must be at least 8 characters long";
    } elseif(empty($id) || empty($firstname) || empty($username) || empty($password) || empty($lastname) || empty($email) || empty($contact)) {
        $error = "Please fill all fields";
    } else {
        $stmt = $db->prepare("INSERT INTO `admin`(`id`, `first`, `last`, `username`, `password`, `email`, `contact`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiss", $id, $firstname, $lastname, $username, $password, $email, $contact);
        if($stmt->execute()) {
            $error = "New record created successfully";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style type="text/css">
        section {
            margin-top: 10px;
        }
        .error {
            color: red;
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
            <li><a href="admin_login.php">HOME</a></li>
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

                <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                
                <li><a href="adminregistration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
              </ul>
                <?php
            }
          ?>

          

      </div>
    </nav>
<section>
    <div class="reg_img">
        <div class="box2">
            <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;"> Library Management System</h1>
            <h1 style="text-align: center; font-size: 25px;">Admin Registration Form</h1>
            <?php if($error !== "") { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form name="Registration" action="" method="post">
                <div class="login">
                    <input class="form-control" type="text" name="id" placeholder="ID" required=""> <br>
                    <input class="form-control" type="text" name="first" placeholder="FIRST NAME" required=""> <br>
                    <input class="form-control" type="text" name="last" placeholder="LAST NAME" required=""><br>
                    <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
                    <input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
                    <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
                    <input class="form-control" type="text" name="contact" placeholder="Phone No" required=""><br>
                    <input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 70px; height: 30px">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
