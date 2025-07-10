<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM criminals WHERE criminal_id = $id");
$criminal = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $occupation = $_POST['occupation'];

    $stmt = $conn->prepare("UPDATE criminals SET nickname=?, father_name=?, gender=?, address=?, age=?, occupation=? WHERE criminal_id=?");
    $stmt->bind_param("ssssdsi", $nickname, $father_name, $gender, $address, $age, $occupation, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Criminal</title>
</head>
<body>
  <h1>Edit Criminal</h1>
  <form method="POST" action="">
    Nickname: <input type="text" name="nickname" value="<?= htmlspecialchars($criminal['nickname']) ?>" required><br><br>
    Father's Name: <input type="text" name="father_name" value="<?= htmlspecialchars($criminal['father_name']) ?>" required><br><br>
    Gender: 
    <select name="gender" required>
      <option value="">--Select--</option>
      <option value="Male" <?= $criminal['gender']=='Male'?'selected':'' ?>>Male</option>
      <option value="Female" <?= $criminal['gender']=='Female'?'selected':'' ?>>Female</option>
      <option value="Other" <?= $criminal['gender']=='Other'?'selected':'' ?>>Other</option>
    </select><br><br>
    Address: <textarea name="address" required><?= htmlspecialchars($criminal['address']) ?></textarea><br><br>
    Age: <input type="number" name="age" value="<?= $criminal['age'] ?>" required><br><br>
    Occupation: <input type="text" name="occupation" value="<?= htmlspecialchars($criminal['occupation']) ?>" required><br><br>
    <input type="submit" value="Update Criminal">
  </form>
  <br>
  <a href="index.php">Back to Home</a>
</body>
</html>
