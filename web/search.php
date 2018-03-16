<?php

include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';

$productsObj = new Products($conn);
$products = $productsObj->filter($_GET['term']);

$return = array();
foreach($products as $product){
    $return[] = array('label' => $product->getName(), 'value' => $product->getId());
}


echo json_encode($return);