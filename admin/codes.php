<?php

// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}


$codes = array(
    100 => "You Sucessfully changed your password!",
    101 => "Something is wrong, please check the entered values.",
    102 => "Password cannot be null.",
    103 => "The new password can not be your old one.",
    104 => "The new password can not be null.",
);

$colors = array(
    100 => "green",
    101 => "red",
    102 => "red",
    103 => "red",
    104 => "red",
);

?>