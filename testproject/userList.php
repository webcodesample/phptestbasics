<?php
include_once('dbcon.php');

$name = trim($_REQUEST['name'] ?? '');

if ($name === '') 
{
    //die("Error: Name cannot be empty.");
    // Step 1: Prepare SQL query with multiple placeholders (?)
    $stmt = $conn->prepare("SELECT * FROM users");
}
else
{
    // Step 1: Prepare SQL query with multiple placeholders (?)
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    // Step 1A: Bind parameters
    // "sid" = string, integer, double
    $stmt->bind_param('s',$name);
}
//Step 2 : Execute the prepared statement
$stmt->execute();

// Step 3: Get the result set and assign to a variable
$result = $stmt->get_result();

// Step 4: Display fetched records
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo 'Name : '.$row['name'].' - Id : '.$row['id'].
        ' - Email : '.$row['email'].' - Age : '.$row['age'].
        ' - Salary : '.$row['salary'].'/- Monthly<br>';
    }
}

//Final : Close statement and database connection
$stmt->close();
$conn->close();
die();
?>