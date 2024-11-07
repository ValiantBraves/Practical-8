<?php
// config.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');  // Your MySQL username
define('DB_PASSWORD', '');      // Your MySQL password
define('DB_NAME', 'cms_db');    // The name of your database

// Attempt to connect to MySQL database
function connect() {
    $link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
    return $link;
}
?>
