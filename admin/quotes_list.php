<?php
require __DIR__.'/../db.php';
require __DIR__.'/../helpers.php';
require_login();

$search = trim($_GET['q'] ?? '');
if ($search !== '') {
  $like = '%' . $conn->real_escape_string($search) . '%';
  $stmt = $conn->prepare("SELECT id, quote_text, author, category, created_at FROM quotes WHERE quote_text LIKE ? OR author LIKE ? OR category LIKE ? ORDER BY id DESC");
  $stmt->bind_param('sss', $like, $like, $like);
  $stmt->execute();
  $quotes = $stmt->get_result();
} else {
  $quotes = $conn->query("SELECT id, quote_text, author, category, created_at FROM quotes ORDER BY id DESC");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Quotes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light min-vh-100">
<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Quotes Admin</a>
    <div>
      <a class="btn btn-outline-secondary btn-sm me-2" href="quotes_list.php">All Quotes</a>
      <a class="btn btn-primary btn-sm me-2" href="quotes_add.php">Add Quote</a>
      <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container py-4">
  <form class="row g-2 mb-3" method="get">
    <div class="col-auto">
      <input type="text" class="form-control" name="q" placeholder="Search..." value="<?php echo e($search); ?>">
    </div>
    <div class="col-auto">
      <button class="btn btn-outline-primary">Search</button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Quote</th>
          <th>Author</th>
          <th>Category</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $quotes->fetch_assoc()): ?>
          <tr>
            <td><?php echo (int)$row['id']; ?></td>
            <td style="max-width:420px"><?php echo e($row['quote_text']); ?></td>
            <td><?php echo e($row['author']); ?></td>
            <td><span class="badge bg-secondary"><?php echo e($row['category']); ?></span></td>
            <td><?php echo e($row['created_at']); ?></td>
            <td>
              <a href="quotes_edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="quotes_delete.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this quote?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
