<?php
// Step 1: Connect to MySQL
$conn = new mysqli('localhost','root','','q_test');

// Step 2: Check connection is successful or not
if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}
?>