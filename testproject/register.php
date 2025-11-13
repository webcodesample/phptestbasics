<?php
require_once 'dbcon.php';
require_once 'helpers.php';


// If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';


// Basic validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
flash('error', 'Invalid email address.');
redirect('register.php');
}
if (strlen($password) < 8) {
flash('error', 'Password must be at least 8 characters.');
redirect('register.php');
}
if ($password !== $password_confirm) {
flash('error', 'Passwords do not match.');
redirect('register.php');
}


// Check if user exists
$stmt = $conn->prepare('SELECT id FROM users_cred WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
$stmt->close();
flash('error', 'Email is already registered.');
redirect('register.php');
}
$stmt->close();


// Hash the password (use PASSWORD_DEFAULT for forward-compatibility)
// You can pass options for algorithms like bcrypt (cost) or Argon2 (memory_cost/time_cost/threads).
$hashOptions = [];
// Example: set bcrypt cost (uncomment to use)
// $hashOptions['cost'] = 12;
$passwordHash = password_hash($password, PASSWORD_DEFAULT, $hashOptions);
if ($passwordHash === false) {
flash('error', 'Server error while hashing password.');
redirect('register.php');
}


// Insert user
$stmt = $conn->prepare('INSERT INTO users_cred (email, password) VALUES (?, ?)');
$stmt->bind_param('ss', $email, $passwordHash);
$ok = $stmt->execute();
$stmt->close();


if ($ok) {
flash('success', 'Registration successful. You may now log in.');
redirect('login.php');
} else {
flash('error', 'Failed to register user (database error).');
redirect('register.php');
}
}


// Show registration form (simple HTML)
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
</head>
<body>
<h2>Register</h2>
<?php if ($m = flash('error')): ?>
<div style="color: red"><?=htmlspecialchars($m)?></div>
<?php endif; ?>
<?php if ($m = flash('success')): ?>
<div style="color: green"><?=htmlspecialchars($m)?></div>
<?php endif; ?>


<form method="post" action="register.php">
<label>Email: <input type="email" name="email" required></label><br>
<label>Password: <input type="password" name="password" required></label><br>
<label>Confirm: <input type="password" name="password_confirm" required></label><br>
<button type="submit">Register</button>
</form>
<p><a href="login.php">Already have an account? Login</a></p>
</body>
</html>