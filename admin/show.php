<?php
include "connection.php";
include "navbar.php";

// Insert new fine into the database
if(isset($_POST['add_fine'])) {
    $roll = $_POST['roll'];
    $delay_fine = $_POST['delay_fine'];

    $query = "INSERT INTO `fines` (student_id, delay_fine) VALUES (?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "id", $roll, $delay_fine);
    mysqli_stmt_execute($stmt);
    ?>
    <script type="text/javascript">
        alert("Fine added successfully.");
        window.location="fines.php";
    </script>
    <?php
}

// Fetch all fines from the database
$query = "SELECT * FROM fines";
$result = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Fines</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Fines</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Delay Fine</th>
                    <th>Paid Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['roll'] . "</td>";
                    echo "<td>" . $row['delay_fine'] . "</td>";
                    echo "<td>" . ($row['paid_status'] ? 'Paid' : 'Unpaid') . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Add Fine</h2>
        <form method="post">
            <div class="form-group">
                <label for="roll">Student Roll Number:</label>
                <input type="text" class="form-control" id="roll" name="roll" required>
            </div>
            <div class="form-group">
                <label for="delay_fine">Delay Fine:</label>
                <input type="text" class="form-control" id="delay_fine" name="delay_fine" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_fine">Add Fine</button>
        </form>
    </div>
</body>
</html>
