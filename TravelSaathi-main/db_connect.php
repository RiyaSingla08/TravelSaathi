<?php
$host =  "b5ilusf2okfawox3z3fd-mysql.services.clever-cloud.com";  // from Clever Cloud
$user = "upgyhf5dekgz1hun";  // username
$pass = "aCn2K7kE47jwzCIIDRHn";  // password
$db   = "b5ilusf2okfawox3z3fd";   // database name
$port = 3306;         // port

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


