<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/User.php';
include '../model/Product.php';
include '../model/ProductReview.php';
session_start();
$curruserID=$_SESSION['userId'];
$curruser=new User($conn,$curruserID);
$curruserName=$curruser->getUsername();

if(!isset($_GET['productID']) && !$_GET['productID']){
	header("Location: home.php");
    exit;
}else{
$productID=$_GET['productID'];
$product=new Product($conn);
$selectedProduct=$product->getProduct($productID);
if(isset($_POST['delBtn'])){
	$product->deleteProduct($productID);
	header("Location: home.php");
    exit;
}
if(isset($_POST['editBtn'])){
	 session_start();
     $_SESSION['product'] = $selectedProduct;
	header("Location: editproduct.php");
    exit;
}

}

?>
<html>
    <head>
		<style>
            .prodInfo{
                float: left;
                width: 40%;
                text-align: center;
                margin-right: 100px;
                margin-top: 30px;
                padding: 15px;
                border:1px solid black;
                
            }
            
			.form {
				margin:0;
				display:inline;
			}

			.form li {
				list-style:none;
			}

			.hide {
				display:none;
			}

			.rating input[type="radio"] {
				position:absolute;
				filter:alpha(opacity=0);
				-moz-opacity:0;
				-khtml-opacity:0;
				opacity:0;
				cursor:pointer;
				width:17px;
			}

			.rating span {
				width:24px;
				height:16px;
				line-height:16px;
				padding:1px 22px 1px 0; /* 1px FireFox fix */
				background:url(stars.png) no-repeat -22px 0;
			}

			.rating input[type="radio"]:checked + span {
				background-position:-22px 0;
			}

			.rating input[type="radio"]:checked + span ~ span {
				background-position:0 0;
			}
			#review{
				
				padding:20px;
				
			}
			.review{
                text-align: left;
				border:1px solid black; 
				margin-bottom:10px;
                padding: 10px;
			}
		</style>
    </head>
    <body>
					<?php if(isset($_SESSION['userId'])): ?>
						<a href="home.php">Home</a>
                        <a href="checkout.php">Check Out</a>
						<a href="logout.php">Log Out</a>
					<?php endif ?>
        <div id="main">
        <div class="prodInfo">
					<h1 style="text-align:left;">Product Info</h1>
                        <?php if($_SESSION['userId']==1): ?>
                            <form method="POST">
                            <button id="editBtn" name="editBtn">Edit Product</button>
                            <button id="delBtn" name="delBtn">Delete Product</button>
                            </form>
            
                        <?php endif; ?>
                    <h2 id="avgRate" style="text-align:left;">Average Rate:
                        <?= $selectedProduct->getProductAvgRate($selectedProduct->getId())?></h2>
            
                    <?php if(isset($_SESSION['userId']) && !in_array($selectedProduct->getId(), $_SESSION['products'])): ?>
					<div style="text-align:right;"><button class="addcart" product-id="<?= $selectedProduct->getId() ?>">Add To Cart</button></div>
					<p id="<?= $selectedProduct->getId() ?>" style="color:red; display:none;">Product added Successfully To cart</p>
                    <?php else:?>
                    <div style="text-align:right;"><button disabled>Add To Cart</button></div>
					<p  style="color:red;">Product added Successfully To cart</p>
                    <?php endif; ?>
					<h2><?= $selectedProduct->getName() ?></h2>
					<br/>
					
					<img src="<?= $selectedProduct->getPhoto() ?>" width="300" height="300" />
					<br/>
                    <p><?= $selectedProduct->getDescription() ?></p>
					<br/>
					
                    <h5><?= $selectedProduct->getPrice() ?></h5>
					
                    
        </div>
					<div id="reviewsDiv" class="prodInfo">
					<h1 style="text-align:left;">Product Reviews</h1>
						<?php 
						
							$reviews=$selectedProduct->getProductReviews($selectedProduct->getId());
							
							foreach($reviews as $review){
								$userID=$review->getUserId();
								$user=new User($conn,$userID);
								$userName=$user->getUsername();
						?>
						<div class="review">
						<h3><?= $userName ?></h3>
						<h5><?= $review->getReview() ?></h5>
						<h6><?= $review->getCreatedAt() ?></h6>
						</div>
						<?php 
							}
						?>
					
                     <?php if($_SESSION['userId']!=1): ?>
					<div id="review">
					
					Leave a Review:
					<br/>
					
					<textarea id="addreviewtext" cols="30" rows="5"></textarea>
					<br/>
					Rate The Product :
					
					<ul class="form">
						<li class="rating">
							<input type="radio" name="rating" value="0" checked /><span class="hide"></span>
							<input type="radio" name="rating" value="1" /><span></span>
							<input type="radio" name="rating" value="2" /><span></span>
							<input type="radio" name="rating" value="3" /><span></span>
							<input type="radio" name="rating" value="4" /><span></span>
							<input type="radio" name="rating" value="5" /><span></span>
						</li>
					</ul>
					<?php 
                    $prodReview=new ProductReview($conn);
                    $check=$prodReview->checkReview($selectedProduct->getId(),$curruserID);  
                        
                    if($check==1):    
                    ?>
					<button id="addreview" product_id="<?= $selectedProduct->getId()?>" user_name="<?= $curruserName?>">Add Review</button>
					<p id="reviewResult" style="color:red; display:none;">review added successfully</p>
					<?php else:?>
                      <button disabled>Add Review</button>
					<p id="reviewResult" style="color:red; ">you can't add review ,you added review before</p>  
                    <?php endif; ?>    
					</div>
					<?php endif; ?>
                    </div>
                    </div>
            
	<script src="js/jquery-3.1.0.min.js"></script>
	
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/script.js"></script> 
</body>
</html>