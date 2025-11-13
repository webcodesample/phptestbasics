<?php
include_once('dbcon.php');

$stmt = $conn->prepare("INSERT INTO login_cred (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

$username = "Ravi";
$password = password_hash('test123',PASSWORD_DEFAULT);
$stmt->execute();

echo "Data inserted successfully!";

$stmt->close();
$conn->close();
?>
