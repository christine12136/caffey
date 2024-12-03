<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'l');
define('DB_NAME', 'employees');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

IF($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
