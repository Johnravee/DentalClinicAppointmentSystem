<?php
// RUN THIS FILE WHEN CLICK TO LOGOUT
session_start();
session_destroy();
session_unset();

header("Location: userLoginForm.php");

?>