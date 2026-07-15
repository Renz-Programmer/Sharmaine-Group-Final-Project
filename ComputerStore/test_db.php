<?php
$host = 'sql105.infinityfree.com';
$username = 'if0_42394236';
$password = 'sharmaineorange';
$database = 'if0_42394236_computer_store';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    echo '<h2>Database connection failed</h2>';
    echo '<p>' . htmlspecialchars($conn->connect_error) . '</p>';
    exit;
}

echo '<h2>Database connection successful</h2>';
echo '<p>Connected to ' . htmlspecialchars($database) . '</p>';

$result = $conn->query("SHOW TABLES");
if ($result) {
    echo '<p>Tables found:</p><ul>';
    while ($row = $result->fetch_array()) {
        echo '<li>' . htmlspecialchars($row[0]) . '</li>';
    }
    echo '</ul>';
}
?>
