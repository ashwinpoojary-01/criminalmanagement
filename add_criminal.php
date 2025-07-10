<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $occupation = $_POST['occupation'];

    $stmt = $conn->prepare("INSERT INTO criminals (nickname, father_name, gender, address, age, occupation) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $nickname, $father_name, $gender, $address, $age, $occupation);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Criminal</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
  <h1>Add New Criminal</h1>
  <form method="POST" action="">
    Nickname: <input type="text" name="nickname" required><br><br>
    Father's Name: <input type="text" name="father_name" required><br><br>
    Gender: 
    <select name="gender" required>
      <option value="">--Select--</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select><br><br>
    Address: <textarea name="address" required></textarea><br><br>
    Age: <input type="number" name="age" required><br><br>
    Occupation: <input type="text" name="occupation" required><br><br>
    <input type="submit" value="Add Criminal">
  </form>
  <br>
  <a href="index.php">Back to Home</a>
</body>
</html>
