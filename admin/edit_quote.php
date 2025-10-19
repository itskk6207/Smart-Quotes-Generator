<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
require_once("../db.php");

$id = intval($_GET['id'] ?? 0);

// Fetch existing quote
$result = $conn->query("SELECT * FROM quotes WHERE id=$id");
if ($result->num_rows === 0) {
    die("Quote not found.");
}
$row = $result->fetch_assoc();

// Update when form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quote = trim($_POST['quote_text']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);

    if ($quote === "" || $author === "" || $category === "") {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $stmt = $conn->prepare("UPDATE quotes SET quote_text=?, author=?, category=? WHERE id=?");
        $stmt->bind_param("sssi", $quote, $author, $category, $id);
        if ($stmt->execute()) {
            echo "<script>alert('Quote updated successfully!'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Error updating quote.');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Quote</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Edit Quote</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Quote Text</label>
            <textarea name="quote_text" class="form-control" rows="3" required><?= htmlspecialchars($row['quote_text']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($row['author']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($row['category']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
