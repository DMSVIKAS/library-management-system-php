<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <?php
        include "connection.php";
        include "navbar.php";
    ?>

    <div class="container">
        <h2>List Of Books</h2>
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <form action="" method="post" class="form-inline pull-right">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
        <div style="margin-top: 20px;"> <!-- Added margin-top here -->
            <?php
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($db, $_POST['search']);
                    $res = mysqli_query($db, "SELECT * FROM `books` WHERE `name` LIKE '%$search%' OR `authors` LIKE '%$search%' OR `department` LIKE '%$search%' ORDER BY `name` ASC");
                } else {
                    $res = mysqli_query($db, "SELECT * FROM `books` ORDER BY `name` ASC");
                }

                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: white;'>";
                echo "<th>ID</th>";
                echo "<th>Book-Name</th>";
                echo "<th>Authors Name</th>";
                echo "<th>Edition</th>";
                echo "<th>Status</th>";
                echo "<th>Quantity</th>";
                echo "<th>Department</th>";
                echo "</tr>";  

                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr>";
                    echo "<td>".$row['bid']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['authors']."</td>";
                    echo "<td>".$row['edition']."</td>";
                    echo "<td>".$row['status']."</td>";
                    echo "<td>".$row['quantity']."</td>";
                    echo "<td>".$row['department']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>
        <div>
            <a href="student.php" class="btn btn-primary">Number of Students</a>
        </div>
    </div>
</body>
</html>
