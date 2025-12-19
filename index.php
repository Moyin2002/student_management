<?php
require 'config.php';

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM students
              WHERE name LIKE '%$search%'
              OR department LIKE '%$search%'";
} else {
    $query = "SELECT * FROM students";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student List</h2>

<form method="GET">
  <input type="text" name="search"
         placeholder="Search by name or department"
         value="<?= htmlspecialchars($search) ?>">
  <button type="submit">Search</button>
</form>

<table border="1">
<tr>
  <th>Name</th>
  <th>Matric No</th>
  <th>Department</th>
  <th>Level</th>
  <th>Actions</th>
</tr>

<?php if (mysqli_num_rows($result) > 0) { ?>
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['matric_no']) ?></td>
      <td><?= htmlspecialchars($row['department']) ?></td>
      <td><?= htmlspecialchars($row['level']) ?></td>
      <td>
        <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete_student.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Delete this student?')">Delete</a>
      </td>
    </tr>
  <?php } ?>
<?php } else { ?>
<tr>
  <td colspan="5">No student found</td>
</tr>
<?php } ?>

</table>

<br>
<div class="add-student">
<a href="add_student.php">➕ Add Student</a>
</div>

</body>
</html>
