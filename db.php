<?php
$conn = new mysqli('localhost', 'root', '', 'quote_api_db'); // <-- check database name
if ($conn->connect_error) {
    die('Database Connection Failed: ' . $conn->connect_error);
}
?>
