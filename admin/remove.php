<?php
include "connection.php";
include "navbar.php";

if(isset($_POST['submit']))
{
    $bid = mysqli_real_escape_string($db, $_POST['bid']);

    $query = "DELETE FROM books WHERE bid = ?";
    $stmt = mysqli_prepare($db, $query);

    if ($stmt === false) {
        die('Error: ' . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, "s", $bid);

    if (mysqli_stmt_execute($stmt)) {
        ?>
        <script type="text/javascript">
            alert("Book Removed Successfully.");
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Error removing book: <?php echo mysqli_error($db); ?>");
        </script>
        <?php
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Remove a Book</h2>
        <form class="book" action="" method="post">
            <input type="text" name="bid" class="form-control" placeholder="Enter Book ID to Remove" required=""><br>
            <button class="btn btn-default" type="submit" name="submit">REMOVE</button>
        </form>
    </div>
</body>
</html>
