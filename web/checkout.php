<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';
session_start();

$totalprice=0;

?>

<html>
    <head>
		<style>
			.addedProduct{
				text-align:center;
				border:1px solid black;
				width:30%;
				float:left;
				margin-right:5px;
			}
			
			.deleteIcon{
				font-size:20px;
				padding:3px;
				border:1px solid black;
				border-radius:50%;
				background-color:red;
				text-align:right;
			}
			
		</style>
    </head>
    <body>
			<?php if(isset($_SESSION['userId'])): ?>
				<a href="home.php">Home</a>
				<a href="logout.php">Log Out</a>
			<?php endif ?>
			<h1>CheckOut Products</h1>
			<?php			
			if(isset($_SESSION['products'])){
			$product = new product($conn);

			//print_r($_SESSION['products']);

			foreach($_SESSION['products'] as $addedproductId){
				$addedProduct=$product ->getProduct($addedproductId);
				$totalprice+=$addedProduct->getPrice();
			?>
			
			<div class="addedproduct" id="<?= $addedProduct->getId() ?>">
			
				<h2><?= $addedProduct->getName() ?></h2>
					<br/>
					
					<img src="<?= $addedProduct->getPhoto() ?>" width="200px" height="200px" />
					<br/>
					
                    <h4><?= $addedProduct->getPrice() ?></h4>
					Delete Item:  <button class="deleteIcon" product-id="<?= $addedProduct->getId() ?>">X</button>
			</div>
			
				
			
			
			<?php	
			}	
				
			}
			?>
			<br/>
			<h1 style="clear:both;">Total: <span id="totalprice" totalPrice="<?= $totalprice ?>" ><?= $totalprice." LE" ?></span></h1>
		<script src="js/jquery-3.1.0.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/script.js"></script> 
	</body>
</html>




