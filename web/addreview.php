<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/ProductReview.php';
include '../model/Product.php';
session_start();
header('Content-Type: application/json');
if(isset($_SESSION['userId']) || $_SESSION['userId']){
	
    $userId=$_SESSION['userId'];

	$productId=$_POST['productId'];
	$rate=$_POST['rateVal'];
	$review=$_POST['review'];
	$productReview=new ProductReview($conn);
	$productReview->setUserId($userId);
	$productReview->setProductId($productId);
	$productReview->setReview($review);
	$productReview->setRate($rate);
	
	$productReview->saveReview();
    $product=new Product($conn);
	$avgRate=$product->getProductAvgRate($productId);
	
}


$output = array(
    'success'  => true,
	'createdAt' =>date("Y-m-d H:i:s",strtotime('+1 hour')),
    'rate' =>$avgRate
);
echo json_encode($output);





