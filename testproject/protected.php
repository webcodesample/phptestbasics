<?php
require_once 'dbcon.php';
require_once 'helpers.php';


if (!isset($_SESSION['user_id'])) {
flash('error', 'You must be logged in to access that page.');
redirect('login.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Protected</title>
</head>
<body>
<h2>Protected Page</h2>
<?php if ($m = flash('success')): ?>
<div style="color: green"><?=htmlspecialchars($m)?></div>
<?php endif; ?>
<p>Welcome, <?=htmlspecialchars($_SESSION['user_email'])?>!</p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>