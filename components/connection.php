<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$database = "crm";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>