<?php
include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Product.php';
include '../model/Products.php';
include '../model/Catagory.php';
include '../model/Catagories.php';

session_start();
?>
<html>
    <head>
        <style>
            .product{
                border: 1px solid black;
				margin-bottom:5px;
				margin-left:20px;
				width:28%;
				height:600px;
				float:left;
                padding: 15px;
                text-align: center;
				
            }
			
        </style>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		
    
    </head>
    <body>
        <?php if(!isset($_SESSION['userId']) || !$_SESSION['userId']): ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php elseif($_SESSION['userId']==1): ?>
            <a href="account.php">Account</a>
            <a href="checkout.php">CheckOut</a>
            <a href="addproduct.php">Add Product</a>
			<a href="logout.php">Log Out</a>
        <?php else : ?>
            <a href="account.php">Account</a>
			<a href="checkout.php">CheckOut</a>
			<a href="logout.php">Log Out</a>
           
        <?php endif; ?>
        <br/>
        <br/>
        <br/>
		<?php if(isset($_SESSION['userId'])): ?>
       
                    <input type="text" placeholder="search for Product" id="searchInput"/>
		<?php endif; ?>
       
        <br/>
        <br/>
        <div class="nav">
		  <a class="active" href="?">All</a>
		  <?php
				$catagories = new Catagories($conn);
				$catagoriesObj = $catagories->getCatagories();
				// echo "<pre>";
			   // print_r($catagoriesObj);
			   //echo "</pre>";
		  ?>
        <?php foreach($catagoriesObj as $catagory): ?>
            <a href="?id=<?= $catagory->getId() ?>"><?= $catagory->getName() ?></a>
		   
        <?php endforeach; ?>
 		
  
		</div>
        <br/>
        <br/>
		 <?php if(!isset($_GET['id']) ) :{
			$products = new Products($conn);
			$productsObj = $products->getProducts(); 
		 } ?>
            <div id="productsDiv">
            <?php foreach($productsObj as $product): ?>
                <div class="product">
				     <?php if(isset($_SESSION['userId']) ): ?>
                     <a href="viewproduct.php?productID=<?= $product->getId() ?>"><?= $product->getName() ?></a>
                     <?php else: ?>
                    <h2><?= $product->getName() ?></h2>
					 <?php endif; ?>
					<br/>
					
					<img src="<?= $product->getPhoto() ?>" width="300" height="300" />
                    <p><?= substr($product->getDescription(), 0, MAXDESC_CHARS)." .." ?></p>
					<br/>
					
                    <h5><?= $product->getPrice() ?></h5>
					<h2>Average Rate:<?= $product->getProductAvgRate($product->getId())?></h2>
					<?php if(isset($_SESSION['userId']) && !in_array($product->getId(), $_SESSION['products'])): ?>
					<button class="addcart" product-id="<?= $product->getId() ?>">Add To Cart</button>
					<p id="<?= $product->getId() ?>" style="color:red; display:none;">Product added Successfully To cart</p>
                     <?php elseif(isset($_SESSION['userId']) && in_array($product->getId(), $_SESSION['products'])):?>
                    <div><button disabled>Add To Cart</button></div>
					<p  style="color:red;">Product added Successfully To cart</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        
        <?php elseif(isset($_GET['id']) && $_GET['id']) :{
			
			$catProducts=Catagory::getProducts($_GET['id'],$conn);
		} ?>
		 
            <?php foreach($catProducts as $product): ?>
                <div class="product">
                    <?php if(isset($_SESSION['userId']) ): ?>
                     <a href="viewproduct.php?productID=<?= $product->getId() ?>"><?= $product->getName() ?></a>
                     <?php else: ?>
                    <h2><?= $product->getName() ?></h2>
					 <?php endif; ?>
					<br/>
					<img src="<?= $product->getPhoto() ?>" width="300" height="300" />
                    <p><?= substr($product->getDescription(), 0, MAXDESC_CHARS)." .." ?></p>
					<br/>
					
                    <h5><?= $product->getPrice() ?></h5>
					<h2>Average Rate:<?= $product->getProductAvgRate($product->getId())?></h2>
                    <?php if(isset($_SESSION['userId']) && !in_array($product->getId(), $_SESSION['products'])): ?>
					<button class="addcart" product-id="<?= $product->getId() ?>">Add To Cart</button>
					<p id="<?= $product->getId() ?>" style="color:red; display:none;">Product added Successfully To cart</p>
                   <?php elseif(isset($_SESSION['userId']) && in_array($product->getId(), $_SESSION['products'])):?>
                    <div><button disabled>Add To Cart</button></div>
					<p  style="color:red;">Product added Successfully To cart</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
				
           
        <?php endif; ?>
		
	  
       
        <br/>
		
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/script.js"></script> 
    </body>
</html>