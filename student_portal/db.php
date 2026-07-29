<?php
// LIVE SERVER DATABASE CONNECTION
$host = "sql310.infinityfree.com"; 
$user = "if0_42530194";           
$pass = "nR9QiUgJXnR6";    
$dbname = "if0_42530194_student_portal"; 

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    // If it fails, this will show you why
    die("Connection failed: " . $conn->connect_error);
}

// Keep this line empty so the page stays blank on success
?>