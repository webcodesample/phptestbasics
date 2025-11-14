<?php
require_once 'common_include.php';


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

include_once 'head.php';
// Show registration form (simple HTML)
?>

<h4 class="text-center text-success mt-5 mb-2">Register</h4>
<?php if ($m = flash('error')): ?>
<div class="text-center alert alert-danger"><?=htmlspecialchars($m)?></div>
<?php endif; ?>
<?php if ($m = flash('success')): ?>
<div class="text-center alert alert-success"><?=htmlspecialchars($m)?></div>
<?php endif; ?>

<div class="container border border-danger p-5 rounded-3 my-2" style="width:100%; max-width:400px;">

<form method="post" action="register.php">
	<div class="d-flex justify-content-center align-items-center gap-2 m-1">
	<div style="width:80px;"><h6>Email:</h6></div>
	<input type="email" class="form-control w-auto" name="email" required>
	</div>
	<div class="d-flex justify-content-center align-items-center gap-2 m-1">
	<div style="width:80px;"><h6>Password:</h6></div>
	<input type="password" class="form-control w-auto" name="password" required>
	</div>
	<div class="d-flex justify-content-center align-items-center gap-2 m-1">
	<div style="width:80px;"><h6>Confirm:</h6></div>
	<input type="password" class="form-control w-auto" name="password_confirm" required></label>
	</div>
	<div class="d-flex flex-wrap justify-content-center align-items-center gap-2 m-1">
	<button class="btn btn-sm btn-success m-1" type="submit">Register</button><br>
	<a href="login.php">Already have an account? Login</a>
	</div>
</form>
</div>
<?php include_once 'foot.php' ?>