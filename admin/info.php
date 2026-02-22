<?php
include "connection.php";
include "navbar.php";

// Fetch records of books lent but not returned yet
$query = "SELECT * FROM lend WHERE return_date = '0000-00-00'";
$result = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lent Books</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Books Lent but Not Returned Yet</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Student Roll</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['bid'] . "</td>";
                    echo "<td>" . $row['roll'] . "</td>";
                    echo "<td>" . $row['issue_date'] . "</td>";
                    echo "<td><input type='date' name='return_date'></td>";
                    echo "<td><a href='lend.php?bid=" . $row['bid'] . "&roll=" . $row['roll'] . "'>Return Book</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
