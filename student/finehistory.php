<?php include "navbar.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Fine History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    include "connection.php";

    $student_id = "student_id"; // Replace with the actual student ID

    // Query to fetch fine history
    $query = "SELECT id, amount, date FROM fines WHERE student_id = '$student_id'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display fine history
        echo "<h2>Fine History</h2>";
        echo "<table>";
        echo "<tr><th>Fine ID</th><th>Fine Amount</th><th>Fine Date</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['delay_fine'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Query to fetch total fine amount
        $query_total = "SELECT SUM(amount) AS total_fine FROM fines WHERE student_id = '$student_id'";
        $result_total = mysqli_query($db, $query_total);
        if ($result_total) {
            $row_total = mysqli_fetch_assoc($result_total);
            $total_fine = $row_total['total_fine'];
            echo "<h3>Total Fine Amount: $total_fine</h3>";
        } else {
            echo "Error fetching total fine amount.";
        }
    } else {
        echo "<h2>No fine history found for this student.</h2>";
    }
    ?>
</body>
</html>
