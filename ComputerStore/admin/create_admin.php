<?php
include("../config.php");

$pass = password_hash("admin123", PASSWORD_DEFAULT);

$conn->query("INSERT INTO users(name,email,password,role)
VALUES('Admin','admin@gmail.com','$pass','admin')");

echo "Admin created!";
?>
    