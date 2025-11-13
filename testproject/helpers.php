<?php
// helpers.php - small helpers for validation and flash messages
session_start();


function flash($key, $msg = null) {
if ($msg === null) {
if (isset($_SESSION['flash'][$key])) {
$m = $_SESSION['flash'][$key];
unset($_SESSION['flash'][$key]);
return $m;
}
return null;
}
$_SESSION['flash'][$key] = $msg;
}


function redirect($url) {
header('Location: ' . $url);
exit;
}
?>