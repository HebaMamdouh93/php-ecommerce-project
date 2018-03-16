<?php

class Products extends BaseEntity
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProducts()
    {
        $query = "SELECT * FROM product";
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($this->conn,$row);
            }
        }
        return $output;
    }
	
	public function filter($keyword)
    {
        $query = "SELECT * FROM product WHERE name LIKE '%{$keyword}%'";
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($this->conn, $row);
            }
        }
        return $output;
    }

}
