<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $matric = mysqli_real_escape_string($conn, $_POST['matric']);
    $dept   = mysqli_real_escape_string($conn, $_POST['dept']);
    $level  = mysqli_real_escape_string($conn, $_POST['level']);

    $sql = "INSERT INTO students (name, matric_no, department, level)
            VALUES ('$name', '$matric', '$dept', '$level')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error adding student";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Student</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
  <input type="text" name="name" placeholder="Student Name" required>
  <input type="text" name="matric" placeholder="Matric Number" required>
  <input type="text" name="dept" placeholder="Department" required>
  <input type="text" name="level" placeholder="Level" required>
  <button name="submit">Add Student</button>
</form>

</body>
</html>
