<?php

session_start();
header('Content-Type: application/json');
if(isset($_SESSION['products'])){
	
	$_SESSION['products'][] = $_POST['productId'];
}



$output = array(
    'success'  => true,
);

echo json_encode($output);
