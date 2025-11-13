<?php
$email = "user@gmail.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $domain = substr(strrchr($email, "@"), 1);
    if (checkdnsrr($domain, "MX")) {
        echo "Valid and domain exists.";
    } else {
        echo "Valid format, but domain does not exist.";
    }
} else {
    echo "Invalid email format.";
}
?>
