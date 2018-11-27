<?php
session_start(); // start session to access the session variables
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['isloggedin']);
session_destroy(); // destroy existing session

header("Location: ../login.php");
?>
