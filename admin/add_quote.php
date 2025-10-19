<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once("../db.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quote = trim($_POST['quote_text']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);

    if ($quote === "" || $author === "" || $category === "") {
        $msg = "All fields are required!";
    } else {
        // Insert new quote
        $stmt = $conn->prepare("INSERT INTO quotes (quote_text, author, category) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $quote, $author, $category);
        
        if ($stmt->execute()) {
            // Reset IDs sequentially after adding
            $conn->query("SET @count = 0;");
            $conn->query("UPDATE quotes SET id = @count:=@count+1;");
            $conn->query("ALTER TABLE quotes AUTO_INCREMENT = 1;");
            
            echo "<script>alert('Quote added successfully! IDs updated.'); window.location='dashboard.php';</script>";
            exit;
        } else {
            $msg = "Error adding quote: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Quote</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center text-primary">Add New Quote</h2>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Quote Text</label>
                <textarea name="quote_text" class="form-control" rows="3" placeholder="Enter quote text" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" placeholder="Enter author name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" placeholder="e.g. Motivation, Life" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success px-4">Add Quote</button>
                <a href="dashboard.php" class="btn btn-secondary px-4">Back to Dashboard</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
