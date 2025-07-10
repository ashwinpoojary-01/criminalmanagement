<?php
include 'db.php';

// Fetch criminals for dropdown
$criminals = $conn->query("SELECT criminal_id, nickname FROM criminals");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $criminal_id = $_POST['criminal_id'];
    $crime_type = $_POST['crime_type'];
    $arrest_date = $_POST['arrest_date'];
    $crime_date = $_POST['crime_date'];

    $stmt = $conn->prepare("INSERT INTO cases (criminal_id, crime_type, arrest_date, crime_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $criminal_id, $crime_type, $arrest_date, $crime_date);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Case</title>
</head>
<body>
  <h1>Add New Case</h1>
  <form method="POST" action="">
    Criminal:
    <select name="criminal_id" required>
      <option value="">--Select Criminal--</option>
      <?php while($row = $criminals->fetch_assoc()) { ?>
        <option value="<?= $row['criminal_id'] ?>"><?= htmlspecialchars($row['nickname']) ?></option>
      <?php } ?>
    </select><br><br>

    Crime Type: <input type="text" name="crime_type" required><br><br>
    Arrest Date: <input type="date" name="arrest_date" required><br><br>
    Crime Date: <input type="date" name="crime_date" required><br><br>

    <input type="submit" value="Add Case">
  </form>
  <br>
  <a href="index.php">Back to Home</a>
</body>
</html>
