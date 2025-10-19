<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__.'/../db.php';

$res = $conn->query("SELECT id, quote_text, author, category FROM quotes ORDER BY RAND() LIMIT 1");
if ($res && $row = $res->fetch_assoc()) {
  echo json_encode([
    'ok' => true,
    'data' => [
      'id' => (int)$row['id'],
      'quote_text' => $row['quote_text'],
      'author' => $row['author'] ?: 'Unknown',
      'category' => $row['category'] ?: 'General'
    ]
  ], JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(['ok' => false, 'error' => 'No quotes found']);
}
?>