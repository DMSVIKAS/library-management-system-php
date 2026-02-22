<?php
include "connection.php";
include "navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_SESSION['roll'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if a file was uploaded
    if ($_FILES['image']['name']) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            echo "Extension not allowed, please choose a JPEG or PNG file.";
            exit;
        }

        $upload_dir = "images/";
        $new_file_name = uniqid() . "." . $file_ext;
        $dest_file = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $dest_file)) {
            $query = "UPDATE student SET firstname=?, lastname=?, username=?, password=?, image=? WHERE roll=?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $username, $password, $dest_file, $roll);
            mysqli_stmt_execute($stmt);

            if ($result) {
                echo "<script>alert('Profile updated successfully.')</script>";
            } else {
                echo "<script>alert('Failed to update profile.')</script>";
            }
        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        // Update the database without changing the image
        $query = "UPDATE student SET firstname=?, lastname=?, username=?, password=? WHERE roll=?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $password, $roll);
        mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Profile updated successfully.')</script>";
        } else {
            echo "<script>alert('Failed to update profile.')</script>";
        }
    }
}

// Fetch student's current information
$roll = $_SESSION['roll'];
$query = "SELECT * FROM student WHERE roll=?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $roll);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <?php if ($row['image']): ?>
            <div class="thumbnail" style="width: 200px; height: 200px; margin-top: 20px;">
                <img src="<?php echo $row['image']; ?>" alt="Profile Image">
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
