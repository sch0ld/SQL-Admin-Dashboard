
<?php

// Redirects the user to login.php if the user isn't logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}


include('../config.php');
session_destroy();

?>