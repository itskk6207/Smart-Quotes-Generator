<?php
require_once("db.php");

$conn->query("CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
)");

$conn->query("INSERT IGNORE INTO admin(username, password) VALUES('admin', SHA1('1234'))");

echo "✅ 'admin' table created and default admin added!";
?>
