<?php
  include "navbar.php";
  include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style type="text/css">
        body
        {
            background-image: url("images/66.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .wrapper
        {
            padding: 10px;
            margin: -20px auto;
            width:900px;
            height: 600px;
            background-color: black;
            opacity: .8;
            color: white;
        }
        .form-control
        {
            height: 70px;
            width: 60%;
        }
        .scroll
        {
            width: 100%;
            height: 300px;
            overflow: auto;
        }
        .message {
            color: white;
            background-color: green;
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="message" style="display: none;"></div>
    <div class="wrapper">
        <h4>If you have any suggestions or questions please comment below.</h4>
        <form style="" action="" method="post">
            <input class="form-control" type="text" name="comment" placeholder="Write something..." required=""><br>    
            <input class="btn btn-default" type="submit" name="submit" value="Comment" style="width: 100px; height: 35px;">       
        </form>
        
        <br><br>
        <div class="scroll">
            <?php
            if(isset($_POST['submit']))
            {
                $comment = mysqli_real_escape_string($db, $_POST['comment']);
                $sql="INSERT INTO `comments` (`comment`) VALUES ('$comment');";
                if(mysqli_query($db,$sql))
                {
                    echo "<script>document.querySelector('.message').innerText = 'Comment added successfully';</script>";
                    echo "<script>document.querySelector('.message').style.display = 'block';</script>";
                    echo "<script>setTimeout(function() {document.querySelector('.message').style.display = 'none';}, 2000);</script>";

                    $q="SELECT * FROM `comments`";
                    $res=mysqli_query($db,$q);

                    echo "<table class='table table-bordered'>";
                    while ($row=mysqli_fetch_assoc($res)) 
                    {
                        echo "<tr>";
                            echo "<td>"; echo $row['comment']; echo "</td>";
                        echo "</tr>";
                    }
                }

            }

            else
            {
                $q="SELECT * FROM `comments`"; 
                    $res=mysqli_query($db,$q);

                    echo "<table class='table table-bordered'>";
                    while ($row=mysqli_fetch_assoc($res)) 
                    {
                        echo "<tr>";
                            echo "<td>"; echo $row['comment']; echo "</td>";
                        echo "</tr>";
                    }
            }
            ?>
        </div>
    </div>
</body>
</html>
