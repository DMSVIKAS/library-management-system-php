<?php
include "connection.php";
include "navbar.php";

if(isset($_POST['issue_book'])) {
    $bid = $_POST['bid'];
    $roll = $_POST['roll'];
    $issue_date = date("Y-m-d");
    $return_date = '0000-00-00'; // Placeholder value for return date if book is not returned yet

    $query = "INSERT INTO lend (bid, roll, issue_date, return_date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $bid, $roll, $issue_date, $return_date);
    mysqli_stmt_execute($stmt);
    ?>
    <script type="text/javascript">
        alert("Book issued successfully.");
        window.location="info.php";
    </script>
    <?php
}

if(isset($_POST['return_book'])) {
    $bid = $_POST['bid'];
    $roll = $_POST['roll'];
    $return_date = date("Y-m-d");

    $query = "UPDATE lend SET return_date=? WHERE bid=? AND roll=?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "sii", $return_date, $bid, $roll);
    mysqli_stmt_execute($stmt);
    ?>
    <script type="text/javascript">
        alert("Book returned successfully.");
        window.location="info.php";
    </script>
    <?php
}

if(isset($_POST['submit_fine'])) {
    $student_id = $_POST['student_id'];
    $delay_fine = $_POST['delay_fine'];

    // Handle the submission of student ID and delay fine here
    // For example, update the student's record in the database with the delay fine
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lend/Return Book</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Lend/Return Book</h2>
        <form method="post">
            <div class="form-group">
                <label for="bid">Book ID:</label>
                <input type="text" class="form-control" id="bid" name="bid" required>
            </div>
            <div class="form-group">
                <label for="roll">Student Roll Number:</label>
                <input type="text" class="form-control" id="roll" name="roll" required>
            </div>
            <button type="submit" class="btn btn-primary" name="issue_book">Issue Book</button>
            <button type="submit" class="btn btn-primary" name="return_book">Return Book</button>
        
    </div>
</body>
</html>
