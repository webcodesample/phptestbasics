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
<?php
// Step 1: Connect to MySQL
$conn = new mysqli("localhost", "root", "", "q_test");

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Prepare SQL query with multiple placeholders (?)
$stmt = $conn->prepare("SELECT id, email FROM users WHERE name = ? AND age = ? AND salary > ?");

// Step 4: Bind parameters
// "sid" = string, integer, double
$stmt->bind_param("sid", $name, $age, $salary);

// Step 5: Assign values to variables (after bind_param)
$name = $_POST['name'];   // string
$age = (int)$_POST['age']; // integer
$salary = (float)$_POST['salary']; // double

// Step 6: Execute the prepared statement
$stmt->execute();

// Step 7: Get the result set
$result = $stmt->get_result();

// Step 8: Display fetched records
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " | Email: " . $row['email'] . "<br>";
    }
} else {
    echo "No matching users found.";
}

// Step 9: Close statement and connection
$stmt->close();
$conn->close();
?>
