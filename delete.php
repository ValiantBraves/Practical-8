<?php
// delete.php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
