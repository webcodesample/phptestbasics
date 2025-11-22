<?php
/*
// Step 1: Connect to MySQL
$conn = new mysqli('localhost','root','','q_test');

// Step 2: Check connection is successful or not
if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}*/


$host = 'localhost';
$dbname = 'q_test';
$user = 'root';
$pass = '';

$dsn = 'mysql:host='.$host.';port=3306;dbname='.$dbname.';charset=utf8mb4';

$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try 
{
    $conn = new PDO($dsn, $user, $pass, $options);
    echo "Connected Successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>