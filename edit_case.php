<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM cases WHERE case_id = $id");
$case = $result->fetch_assoc();

$criminals = $conn->query("SELECT criminal_id, nickname FROM criminals");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $criminal_id = $_POST['criminal_id'];
    $crime_type = $_POST['crime_type'];
    $arrest_date = $_POST['arrest_date'];
    $crime_date = $_POST['crime_date'];

    $stmt = $conn->prepare("UPDATE cases SET criminal_id=?, crime_type=?, arrest_date=?, crime_date=? WHERE case_id=?");
    $stmt->bind_param("isssi", $criminal_id, $crime_type, $arrest_date, $crime_date, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Case</title>
</head>
<body>
  <h1>Edit Case</h1>
  <form method="POST" action="">
    Criminal:
    <select name="criminal_id" required>
      <option value="">--Select Criminal--</option>
      <?php while($row = $criminals->fetch_assoc()) { ?>
        <option value="<?= $row['criminal_id'] ?>" <?= ($case['criminal_id'] == $row['criminal_id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($row['nickname']) ?>
        </option>
      <?php } ?>
    </select><br><br>

    Crime Type: <input type="text" name="crime_type" value="<?= htmlspecialchars($case['crime_type']) ?>" required><br><br>
    Arrest Date: <input type="date" name="arrest_date" value="<?= $case['arrest_date'] ?>" required><br><br>
    Crime Date: <input type="date" name="crime_date" value="<?= $case['crime_date'] ?>" required><br><br>

    <input type="submit" value="Update Case">
  </form>
  <br>
  <a href="index.php">Back to Home</a>
</body>
</html>
