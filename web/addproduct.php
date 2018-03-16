<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../classes/config.php';
include '../model/BaseEntity.php';
include '../model/Catagory.php';
include '../model/Catagories.php';
include '../model/Product.php';

$errorProductname=$errorProductdesc=$errorProductprice="";

if(!empty($_POST))
{
	
	if(!isset($_POST['productName']) || !$_POST['productName'])
    {
       $errorProductname .= "This Field required.";
    }
	
	if(!isset($_POST['productDesc']) || !$_POST['productDesc'])
    {
       $errorProductdesc .= "This Field required.";
    }else
    {
        if(strlen($_POST['productDesc']) < MAXDESC_CHARS)
        {
            $errorProductdesc .= "Max Length is 100 Char";
        }
        
    }
	
	if(!isset($_POST['productPrice']) || !$_POST['productPrice'])
    {
       $errorProductprice .= "This Field required.";
    }
    

    if($errorProductname == "" && $errorProductdesc== "" && $errorProductprice=="")
    {
	$filename = $_FILES['fileToUpload']['tmp_name'];
    $filePath = '/uploads/productImages/' . time() . '.png';
    $destination = __DIR__ . $filePath;
    if(!move_uploaded_file($filename, $destination))
    {
        die('cant upload');
    }
	$product=new Product($conn);
    $product->setName($_POST['productName']);
	$product->setDescription($_POST['productDesc']);
	$product->setPrice($_POST['productPrice']);
    $catID=$_POST['productCatagory'];
	$product->setCatagoryId($catID);
	$product->setPhoto(substr($filePath, 1));
	
    
    $product->saveProduct();
    
    header("Location: home.php");
    exit;
}
}
?>
<html>
    <head>
		<style>
		.error{
			color:red;
		}
		</style>
    </head>
    <body>
<h1>Add new Product</h1>

<form method="post" enctype="multipart/form-data">
    Select The Catagory of The New Product :
	<br/>
	<select name="productCatagory">
		
         <?php
				$catagories = new Catagories($conn);
				$catagoriesObj = $catagories->getCatagories();
				
		  ?>
        <?php foreach($catagoriesObj as $catagory): ?>
            
		    <option value="<?= $catagory->getId() ?>"><?= $catagory->getName() ?></option>
        <?php endforeach; ?>
    </select>
	<br/>
	<br/>
	Enter The Name of The new product:
	<br/>
	<input name="productName" type="text" />
	<br/>
	<div class="error">
	<?php echo $errorProductname ?>
	</div>
	<br/>
	
	Enter The description of The new product:
	<br/>
	<textarea name="productDesc" type="text" cols="50" rows="10" ></textarea>
	<div class="error">
	<?php echo $errorProductdesc ?>
	</div>
	Enter The price of The new product:
	<br/>
	<input name="productPrice" type="text" />
	<br/>
	<div class="error">
	<?php echo $errorProductprice ?>
	</div>
	<br/>
	Choose The Photo of The new product:
	<br/>
    <input type="file" name="fileToUpload" id="fileToUpload"/> 
    <br/>
	<br/>
	<button type="submit">Submit</button>	
</form>
</body>
</html>