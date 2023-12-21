<?php
session_start();
if (isset($_SESSION['frompasswordphp']))
{
	unset($_SESSION['frompasswordphp']);
}

header("Location: password.php");
?>