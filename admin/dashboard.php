<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
require_once("../db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Quote Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-3">Admin Dashboard</h2>
  <a href='edit_quote.php?id=<?= $row['id'] ?>' class='btn btn-warning btn-sm'>Edit</a>
  <a href='delete_quote.php?id=<?= $row['id'] ?>' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure?')">Delete</a>
  <a href="add_quote.php" class="btn btn-success mb-3">+ Add New Quote</a>




    <?php
    $result = $conn->query("SELECT * FROM quotes ORDER BY id DESC");
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead><tr><th>ID</th><th>Quote</th><th>Author</th><th>Category</th><th>Actions</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['quote_text']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td>
                    <a href='edit_quote.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete_quote.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No quotes found.</p>";
    }
    ?>
</div>
</body>
</html>
