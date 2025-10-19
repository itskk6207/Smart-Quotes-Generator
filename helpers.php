<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function is_logged_in() {
  return isset($_SESSION['admin_id']);
}

function require_login() {
  if (!is_logged_in()) {
    header('Location: login.php');
    exit;
  }
}

function e($str) {
  return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>