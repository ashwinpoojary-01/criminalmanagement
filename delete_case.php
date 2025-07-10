<?php
include 'db.php';

$id = $_GET['id'];

// Delete case
$conn->query("DELETE FROM cases WHERE case_id = $id");

header("Location: index.php");
exit;
?>
