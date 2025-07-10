<?php
include 'db.php';

// Fetch criminals
$criminals = $conn->query("SELECT * FROM criminals");

// Fetch cases with criminal info
$cases = $conn->query("SELECT cases.*, criminals.nickname FROM cases 
                      LEFT JOIN criminals ON cases.criminal_id = criminals.criminal_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Criminal Management System</title>
  <link rel="stylesheet" href="style.css">

  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 30px;}
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left;}
    th { background: #eee;}
    a { text-decoration: none; margin: 0 5px;}
  </style>
</head>
<body>
  <h1>Criminal Management System</h1>

  <h2>Criminals</h2>
  <a href="add_criminal.php">Add New Criminal</a>
  <table>
    <tr>
      <th>ID</th><th>Nickname</th><th>Father's Name</th><th>Gender</th><th>Address</th><th>Age</th><th>Occupation</th><th>Actions</th>
    </tr>
    <?php while($row = $criminals->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['criminal_id'] ?></td>
      <td><?= htmlspecialchars($row['nickname']) ?></td>
      <td><?= htmlspecialchars($row['father_name']) ?></td>
      <td><?= htmlspecialchars($row['gender']) ?></td>
      <td><?= htmlspecialchars($row['address']) ?></td>
      <td><?= $row['age'] ?></td>
      <td><?= htmlspecialchars($row['occupation']) ?></td>
      <td>
        <a href="edit_criminal.php?id=<?= $row['criminal_id'] ?>">Edit</a> | 
        <a href="delete_criminal.php?id=<?= $row['criminal_id'] ?>" onclick="return confirm('Delete this criminal?')">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>

  <h2>Cases</h2>
  <a href="add_case.php">Add New Case</a>
  <table>
    <tr>
      <th>Case ID</th><th>Criminal</th><th>Crime Type</th><th>Arrest Date</th><th>Crime Date</th><th>Actions</th>
    </tr>
    <?php while($row = $cases->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['case_id'] ?></td>
      <td><?= htmlspecialchars($row['nickname'] ?: 'Unknown') ?></td>
      <td><?= htmlspecialchars($row['crime_type']) ?></td>
      <td><?= $row['arrest_date'] ?></td>
      <td><?= $row['crime_date'] ?></td>
      <td>
        <a href="edit_case.php?id=<?= $row['case_id'] ?>">Edit</a> | 
        <a href="delete_case.php?id=<?= $row['case_id'] ?>" onclick="return confirm('Delete this case?')">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
