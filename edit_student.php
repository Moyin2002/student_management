<?php
require 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "Student not found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">
  <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
  <input type="text" name="matric" value="<?= htmlspecialchars($student['matric_no']) ?>" required>
  <input type="text" name="dept" value="<?= htmlspecialchars($student['department']) ?>" required>
  <input type="text" name="level" value="<?= htmlspecialchars($student['level']) ?>" required>
  <button name="update">Update Student</button>
</form>

</body>
</html>

<?php
if (isset($_POST['update'])) {
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $matric = mysqli_real_escape_string($conn, $_POST['matric']);
    $dept   = mysqli_real_escape_string($conn, $_POST['dept']);
    $level  = mysqli_real_escape_string($conn, $_POST['level']);

    $sql = "UPDATE students SET
            name='$name',
            matric_no='$matric',
            department='$dept',
            level='$level'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Update failed";
    }
}
?>
