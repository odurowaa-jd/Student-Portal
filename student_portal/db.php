<?php
$host = "localhost";
$user = "root";

$pass = "YOUR-DATABASE-PASSWORD"; 
$dbname = "student_portal";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>