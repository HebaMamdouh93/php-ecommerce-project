<?php

class Product extends BaseEntity
{

    public $id;
    public $name;
    public $description;
    public $photo;
    public $price;
	public $catagoryId;
	public $conn;

	
    public function __construct($conn, $productArray =false)
    {
        $this->conn = $conn;
        $this->id = $productArray['id'];
		$this->name = $productArray['name'];
        $this->description = $productArray['description'];
		$this->photo = $productArray['photo'];
		$this->price = $productArray['price'];
		$this->catagoryId = $productArray['catagory_id'];
        
    }
	
	
	public function saveProduct()
    {
      
		$query ="INSERT INTO `product` (`id`, `name`, `description`, `photo`, `price`, `catagory_id`)".
		"VALUES (NULL, '{$this->getName()}', '{$this->getDescription()}', '{$this->getPhoto()}', '{$this->getPrice()}', '{$this->getCatagoryId()}');"; 
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        
    }
	
	public function getProduct($productId)
    {
      
		$query ="SELECT * FROM `product` WHERE id='{$productId}'";
		
        $result = $this->conn->query($query);
        
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            
                $product = new product($this->conn, $row);
            
        }
        return $product;
    }
	
	public function deleteProduct($productId)
    {
        
		$query ="DELETE FROM `product` WHERE `product`.`id`='{$productId}'";
		 mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
		
       
    }
	
	public function updateProduct($productId)
    {
        
		
        $query ="UPDATE `product` SET `name` = '{$this->getName()}', `description` = '{$this->getDescription()}', `photo` = '{$this->getPhoto()}', `price` = '{$this->getPrice()}', `catagory_id` = '{$this->getCatagoryId()}' WHERE `product`.`id` = {$productId};";
		 mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
	}
	
	public function getProductReviews($productId)
    {
      
		$query ="SELECT * FROM `product_reviews` WHERE product_id='{$productId}'";
		
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
				
				while ($row = $result->fetch_assoc())
            {
                $output[] = new ProductReview($this->conn, $row);
            }
            
        }
        return $output;
    }
	
	//SELECT AVG(rate) FROM `product_reviews` WHERE product_id=1
	public function getProductAvgRate($prodId)
	{
		$query="SELECT AVG(rate) as avgRate FROM `product_reviews` WHERE product_id='{$prodId}'";
		$result=$this->conn->query($query);
		if($result->num_rows >0){
			$row=$result->fetch_assoc();
			if($averageRate=$row['avgRate']){
				return $averageRate;
			}else{
				return 0;
			}
			
		}
		
	}

}
