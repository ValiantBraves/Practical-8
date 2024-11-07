<?php
// db.php
require_once 'config.php';

function getDbConnection() {
    $conn = connect();
    return $conn;
}
?>
