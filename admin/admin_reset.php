<?php
include "connection.php";

$error = ""; // Initialize error message

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Check if email exists
    $check_query = "SELECT * FROM `admin` WHERE `email` = '$email'";
    $check_result = mysqli_query($db, $check_query);
    if(mysqli_num_rows($check_result) == 0) {
        $error = "Email not found";
    } else {
        // Display a form to reset the password
        echo '
        <form name="ResetPassword" action="" method="post">
            <div class="login">
                <input type="hidden" name="email" value="' . $email . '">
                <input class="form-control" type="password" name="new_password" placeholder="New Password" required=""><br>
                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required=""><br>
                <input class="btn btn-default" type="submit" name="reset_submit" value="Reset Password" style="color: black; width: 120px; height: 30px">
            </div>
        </form>';
    }
}

if(isset($_POST['reset_submit'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    if($new_password != $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Update the password in the database without hashing
        $update_query = "UPDATE `admin` SET `password`='$new_password' WHERE `email`='$email'";
        if(mysqli_query($db, $update_query)) {
            $error = "Password reset successful.";
        } else {
            $error = "Error updating password: " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
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
            <li><a href="">HOME</a></li>
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
                  <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                </ul>
              <?php
            }
            else
            {   ?>
              <ul class="nav navbar-nav navbar-right">

                <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGOUT</span></a></li>
                
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
            <h1 style="text-align: center; font-size: 25px;">Admin Password Reset</h1>
            <?php if($error !== "") { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form name="PasswordReset" action="" method="post">
                <div class="login">
                    <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
                    <input class="btn btn-default" type="submit" name="submit" value="Reset Password" style="color: black; width: 120px; height: 30px">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
