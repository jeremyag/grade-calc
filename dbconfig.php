<?php
require_once("load_env.php");

$servername = isset($_ENV["DB_SERVER_NAME"]) ? $_ENV["DB_SERVER_NAME"] : "";
$username = isset($_ENV["DB_USER_NAME"])  ? $_ENV["DB_USER_NAME"] : "";
$password = isset($_ENV["DB_PASSWORD"]) ? $_ENV["DB_PASSWORD"] : "";
$dbname = isset($_ENV["DB_NAME"]) ? $_ENV["DB_NAME"] : "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>