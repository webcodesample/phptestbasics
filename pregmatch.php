<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "✅ Valid Email: " . htmlspecialchars($email);
    } else {
        echo "❌ Invalid Email Format";
    }
}
?>

<form method="post" action="">
    <input type="text" name="email" placeholder="Enter your email">
    <input type="submit" value="Validate">
</form>