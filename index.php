<?php require __DIR__.'/db.php'; ?>
<?php
$q = $conn->query("SELECT id, quote_text, author, category FROM quotes ORDER BY RAND() LIMIT 1");
$quote = $q ? $q->fetch_assoc() : null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Random Quote Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4 p-md-5 text-center">
            <h1 class="h4 mb-4">✨ Random Quote Generator</h1>
            <div id="quoteBox">
              <?php if ($quote): ?>
                <p id="quoteText" class="fs-4">“<?php echo htmlspecialchars($quote['quote_text']); ?>”</p>
                <p id="quoteAuthor" class="text-muted mb-1">— <?php echo htmlspecialchars($quote['author'] ?? 'Unknown'); ?></p>
                <span id="quoteCategory" class="badge bg-secondary"><?php echo htmlspecialchars($quote['category'] ?? 'General'); ?></span>
              <?php else: ?>
                <p class="text-danger">No quotes found. Please add some in the admin panel.</p>
              <?php endif; ?>
            </div>
            <button id="nextBtn" class="btn btn-primary btn-lg mt-4">Next Quote</button>
            <a href="admin/login.php" class="btn btn-outline-secondary btn-lg mt-4 ms-2">Admin</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
