<?php
$conn = new mysqli("sql105.infinityfree.com", "if0_42394236", "sharmaineorange", "if0_42394236_computer_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>