<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(isset($_SESSION['userId']) && $_SESSION['userId']){
	unset($_SESSION['userId']);
	unset($_SESSION['user']);
	unset($_SESSION['products']);
	header('Location: home.php');
	exit;
}


?>