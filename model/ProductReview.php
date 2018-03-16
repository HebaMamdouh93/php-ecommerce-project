<?php

class ProductReview extends BaseEntity
{

    public $id;
    public $review;
	public $rate;
    public $userId;
    public $productId;
    public $createdAt;
	
	public function __construct($conn, $reviewsArray =false)
    {
        $this->conn = $conn;
        $this->id = $reviewsArray['id'];
		$this->review = $reviewsArray['review'];
        $this->rate = $reviewsArray['rate'];
		$this->userId = $reviewsArray['user_id'];
		$this->productId = $reviewsArray['product_id'];
		$this->createdAt = $reviewsArray['created_at'];
        
    }
	
	public function saveReview()
    {
      
		$query ="INSERT INTO `product_reviews` (`id`, `created_at`, `product_id`, `user_id`, `review`, `rate`)".
		"VALUES (NULL, NOW(), '{$this->getProductId()}', '{$this->getUserId()}', '{$this->getReview()}', '{$this->getRate()}');"; 
		 
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        
    }
    
    public function checkReview($prodId,$userId)
    {
      
		$query ="SELECT * FROM `product_reviews` WHERE product_id='{$prodId}' AND user_id='{$userId}'";
		
        $result = $this->conn->query($query);
       
        if($result->num_rows > 0)
        {
				
		return 0;	
            
        }else{
            
            return 1;
        }
       
        
    }

}
