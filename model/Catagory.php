<?php

class Catagory extends BaseEntity
{

    public $id;
    public $name;
   
	public $conn;

	
    public function __construct($conn ,$catagoryArray)
    {
        $this->conn = $conn;
        $this->id = $catagoryArray['id'];
        $this->name = $catagoryArray['name'];
       
    }
	
	public static function getProducts($catagoryId,$conn)
	{
		$query = "SELECT * FROM product WHERE catagory_id={$catagoryId}";
            $result = $conn->query($query);
            if($result->num_rows > 0)
            {
				while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($conn,$row);
            }
                
			}
			return $output;
	}		
	

}
