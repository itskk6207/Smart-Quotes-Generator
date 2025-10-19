<?php
require_once("../db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the selected quote
    $conn->query("DELETE FROM quotes WHERE id=$id");

    // Reset IDs to stay sequential
    $conn->query("SET @count = 0;");
    $conn->query("UPDATE quotes SET id = @count:=@count+1;");
    $conn->query("ALTER TABLE quotes AUTO_INCREMENT = 1;");

    header("Location: dashboard.php?msg=Quote+Deleted+Successfully");
    exit;
} else {
    header("Location: dashboard.php?msg=Invalid+Request");
    exit;
}
?>
