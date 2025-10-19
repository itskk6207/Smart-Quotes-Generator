<?php
session_start();
require_once("../db.php");

$msg = ""; // initialize message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    if ($u === "" || $p === "") {
        $msg = "Username and password cannot be empty.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=SHA1(?)");
        $stmt->bind_param("ss", $u, $p);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $_SESSION['admin'] = $u;
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Invalid username or password."; // <-- This will show
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <form method="post" class="card p-4 shadow" style="width:320px;">
        <h3 class="mb-3 text-center">Admin Login</h3>
        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-primary w-100">Login</button>
        <?php if(!empty($msg)) echo "<p class='text-danger mt-2 text-center'>{$msg}</p>"; ?>
    </form>
</body>
</html>
