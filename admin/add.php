<?php
include "connection.php";
include "navbar.php";

if(isset($_POST['submit']))
{
    $bid = mysqli_real_escape_string($db, $_POST['bid']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $authors = mysqli_real_escape_string($db, $_POST['authors']);
    $edition = mysqli_real_escape_string($db, $_POST['edition']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $department = mysqli_real_escape_string($db, $_POST['department']);

    $query = "INSERT INTO books (bid, name, authors, edition, status, quantity, department) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);

    if ($stmt === false) {
        die('Error: ' . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $bid, $name, $authors, $edition, $status, $quantity, $department);

    if (mysqli_stmt_execute($stmt)) {
        ?>
        <script type="text/javascript">
            alert("Book Added Successfully.");
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Error adding book: <?php echo mysqli_error($db); ?>");
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Books</h2>
        <form class="book" action="" method="post">
            <input type="text" name="bid" class="form-control" placeholder="Book id" required=""><br>
            <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
            <input type="text" name="authors" class="form-control" placeholder="Authors Name" required=""><br>
            <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
            <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
            <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
            <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
            <button class="btn btn-default" type="submit" name="submit">ADD</button>
        </form>
    </div>
</body>
</html>
