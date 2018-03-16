<?php

session_start();
header('Content-Type: application/json');
if(isset($_SESSION['products'])){
	
	/*
	$key=array_search($_GET['name'],$_SESSION['name']);
    if($key!==false)
    unset($_SESSION['name'][$key]);
    $_SESSION["name"] = array_values($_SESSION["name"]);
	*/
	$productId=$_POST['productId'];
	$key=array_search($productId,$_SESSION['products']);

    if($key!==false)
    unset($_SESSION['products'][$key]);
    $_SESSION["products"] = array_values($_SESSION["products"]);
	
	
}



$output = array(
    'success'  => true,
);

echo json_encode($output);
