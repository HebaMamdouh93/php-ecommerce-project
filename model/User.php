<?php

$conn;


class User extends BaseEntity
{

    public $id;
    public $username;
    public $password;
    public $email;
    public $photo;
    public $conn;

    public function __construct($conn, $userId = false)
    {
        $this->conn = $conn;
        if($userId)
        {
            $query = "SELECT * FROM user WHERE id={$userId}";
            $result = $this->conn->query($query);
            if($result->num_rows > 0)
            {
                // output data of each row
                $row = $result->fetch_assoc();
                foreach($row as $key => $value)
                {
                    $this->$key = $value;
                }
             
            }
            else
            {
                die('User Not Found');
            }
        }
    }

    /**
     * save for new user to database
     */
    public function save()
    {
        
        $query = "INSERT INTO `user` (`id`, `username`, `photo`, `email`, `password`) "
                . "VALUES (NULL, '{$this->getUsername()}', '{$this->getPhoto()}', '{$this->getEmail()}', '{$this->getPassword()}');";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $this->id = mysqli_insert_id($this->conn);
        return $this->id;
    }

    public function update()
    {
        $query = "UPDATE `user` SET `photo` = '{$this->getPhoto()}',`email` = '{$this->getEmail()}',`username` = '{$this->getUsername()}' WHERE `user`.`id` = {$this->id}";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }

    

}
