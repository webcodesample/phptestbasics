<?php
include_once 'dbcon.php';

$stmt = $conn->prepare("SELECT * FROM login_cred WHERE id = ?");
$stmt->bind_param('i',$id);
$id = $_REQUEST['id'];

$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc())
{
	if(password_verify('test1213',$row['password']))
	$row['passwordmacthed'] = true;
	else
	$row['passwordmacthed'] = false;

	print_r($row);	
}

$stmt->close();
?>