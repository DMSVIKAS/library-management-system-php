<?php
include "connection.php";
include "navbar.php";

// Function to sanitize user input for SQL queries
function sanitize($input) {
    global $db;
    return mysqli_real_escape_string($db, $input);
}

// Initialize variables
$search = "";
$error = "";
$tableHeader = false;

if (isset($_POST['submit'])) {
    // Sanitize user input
    $search = sanitize($_POST['search']);

    // Query to search for students
    $query = "SELECT firstname, lastname, username, roll, email, contact FROM student WHERE username LIKE '%$search%'";

    // Execute the query
    $result = mysqli_query($db, $query);

    if (!$result) {
        $error = "Error: " . mysqli_error($db);
    } elseif (mysqli_num_rows($result) == 0) {
        $error = "Sorry! No student found with that username. Try searching again.";
    } else {
        $tableHeader = true;
    }
}

// Function to display table rows
function displayTableRow($row) {
    echo "<tr>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['roll'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['contact'] . "</td>";
    echo "</tr>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <style type="text/css">
        .srch {
            padding-left: 900px;
        }
    </style>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>


<div class="srch">
    <form class="navbar-form" method="post" name="form1">
        <input class="form-control" type="text" name="search" placeholder="Student username.." value="<?php echo $search; ?>" required="">
        <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span> Search
        </button>
    </form>
</div>

<div class="container">
    <h2>List Of Students</h2>

    <?php
    if ($error) {
        echo "<div style='color: red;'>$error</div>";
    } elseif ($tableHeader) {
        echo "<table class='table table-bordered table-hover' >";
        echo "<tr style='background-color: #6db6b9e6;'>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Username</th>";
        echo "<th>Roll</th>";
        echo "<th>Email</th>";
        echo "<th>Contact</th>";
        echo "</tr>";

        // Display table rows
        while ($row = mysqli_fetch_assoc($result)) {
            displayTableRow($row);
        }

        echo "</table>";
    }
    ?>
</div>

</body>
</html>
