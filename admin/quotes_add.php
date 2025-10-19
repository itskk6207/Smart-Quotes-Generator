<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $q = $_POST['quote_text'];
  $a = $_POST['author'];
  $c = $_POST['category'];
  $stmt = $conn->prepare("INSERT INTO quotes (quote_text, author, category) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $q, $a, $c);
  $stmt->execute();
  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Quote</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<h3>Add New Quote</h3>
<form method="post">
  <textarea name="quote_text" class="form-control mb-2" rows="3" placeholder="Quote" required></textarea>
  <input name="author" class="form-control mb-2" placeholder="Author">
  <input name="category" class="form-control mb-2" placeholder="Category">
  <button class="btn btn-success">Save</button>
  <a href="dashboard.php" class="btn btn-secondary">Back</a>
</form>
</body>
</html>
