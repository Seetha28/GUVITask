<?php
// database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'my_database';

// create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}
?>