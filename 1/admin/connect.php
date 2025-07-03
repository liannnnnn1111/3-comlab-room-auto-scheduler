<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = "3307";
$dbname = "auto-scheduler";

$conn = new mysqli($servername, $username, $password, $dbname, port:$port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
