<?php
require_once 'dbcon.php';
require_once 'helpers.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';


// Basic validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
flash('error', 'Invalid email or password.');
redirect('login.php');
}


$stmt = $conn->prepare('SELECT id, password FROM users_cred WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($id, $passwordHash);
if ($stmt->fetch()) {
$stmt->close();
// Verify password
if (password_verify($password, $passwordHash)) {
// Optionally rehash if algorithm or options have changed
$rehashOptions = [];
// Example: if you later decide bcrypt cost = 12
// $rehashOptions['cost'] = 12;
if (password_needs_rehash($passwordHash, PASSWORD_DEFAULT, $rehashOptions)) {
$newHash = password_hash($password, PASSWORD_DEFAULT, $rehashOptions);
if ($newHash !== false) {
$up = $conn->prepare('UPDATE users_cred SET password = ? WHERE id = ?');
$up->bind_param('si', $newHash, $id);
$up->execute();
$up->close();
}
}


// Login successful: set session
session_regenerate_id(true);
$_SESSION['user_id'] = $id;
$_SESSION['user_email'] = $email;
flash('success', 'Logged in successfully.');
redirect('protected.php');
} else {
flash('error', 'Invalid email or password.');
redirect('login.php');
}
} else {
$stmt->close();
flash('error', 'Invalid email or password.');
redirect('login.php');
}
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if ($m = flash('error')): ?>
<div style="color: red"><?=htmlspecialchars($m)?></div>
<?php endif; ?>
<?php if ($m = flash('success')): ?>
<div style="color: green"><?=htmlspecialchars($m)?></div>
<?php endif; ?>


<form method="post" action="login.php">
<label>Email: <input type="email" name="email" required></label><br>
<label>Password: <input type="password" name="password" required></label><br>
<button type="submit">Login</button>
</form>
<p><a href="register.php">Create account</a></p>
</body>
</html>