<?php
// Const with credentials for MySql database
define('DB_SERVERNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'edusogno');
define('DB_PORT', 8889);

// Connection to MySql
$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check for connection errors
if($conn && $conn->connect_error) {
    die($conn->connect_error);
} 
?>