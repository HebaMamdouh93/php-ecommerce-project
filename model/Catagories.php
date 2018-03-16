<?php

class Catagories extends BaseEntity
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCatagories()
    {
        $query = "SELECT * FROM catagory";
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Catagory($this->conn,$row);
            }
        }
        return $output;
    }

}
