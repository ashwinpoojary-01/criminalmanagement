<?php
include 'db.php';

$id = $_GET['id'];

// Delete criminal (cases linked will be deleted because of ON DELETE CASCADE)
$conn->query("DELETE FROM criminals WHERE criminal_id = $id");

header("Location: index.php");
exit;
?>
