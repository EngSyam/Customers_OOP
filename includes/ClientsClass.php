<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 06/07/2018
 * Time: 10:29 ص
 */
/**
 * get all clients as array
 */
class clients
{
    private $connection;
    public function __construct()
    {
        $this->connection=new mysqli(SERVER,DBUSER,DBPASS,DBNAME);
        if(!$this->connection)
            exit('error : '.$this->connection->error);
    }
    public function getClients()
    {
        $query      = $this->connection->query("SELECT * FROM `clients`");
        if(!$query)
            exit('error : '.$this->connection->error);
        $clients=[]; //store all clients
        if( $query->num_rows > 0 )
        {
            while($row = $query->fetch_assoc())
                $clients[]=$row;
        }
        return $clients;
    }

    /**
     * GET CLIENT BY ID
     * @param $id
     * @return array|null
     */
    public function getClient($id)
    {
        $query      = $this->connection->query("SELECT * FROM `clients` WHERE `id`=$id");
        if(!$query)
            exit('error : '.$this->connection->error);
        $client=[];
        if($query->num_rows>0)
        {
            $client = $query->fetch_assoc();
        }
        return $client;
    }

    /**
     * Search clients
     * @param $keyword
     * @return array
     */
    public function searchClients($keyword)
    {
        $query      = $this->connection->query("SELECT * FROM `clients` WHERE `name` LIKE '%$keyword%' OR `email` LIKE '%$keyword%' OR `city` LIKE '%$keyword%' OR `phone` LIKE '%$keyword%' ");
        if(!$query)
            exit('error : '.$this->connection->error);
        $clients=[]; //store all clients
        if($query->num_rows > 0 )
        {
            while($row=$query->fetch_assoc())
                $clients[]=$row;
        }
        return $clients;
    }

    /**
     * Add New Client
     * @param $name
     * @param $email
     * @param $city
     * @param $phone
     * @return bool
     */
    public function addClient($name,$email,$city,$phone,$image='no-image.jpg')
    {
        $query      = $this->connection->query("INSERT INTO `clients`(`name`, `email`, `city`, `phone`,`image`) VALUES ('$name','$email','$city','$phone','$image')");
        if($query && $this->connection->affected_rows > 0)
            return true;
        return false;
    }
    /**
     * UPDATE CLIENT BY ID
     * @param $id
     * @param $name
     * @param $email
     * @param $city
     * @param $phone
     * @return bool
     */
    public function updateClient($id,$name,$email,$city,$phone,$image)
    {
        $query      = $this->connection->query("UPDATE `clients` SET `name`='$name',`email`='$email',`city`='$city',`phone`='$phone',`image`='$image' WHERE `id`=$id");
        if($query && $this->connection->affected_rows > 0)
            return true;
        return false;
    }

    /**
     * DELETE CLIENT BY ID
     * @param $id
     * @return bool
     */
    public function deleteClient($id)
    {
        $client_data = $this->getClient($id);
        $client_image=$client_data['image'];
        $query      = $this->connection->query("DELETE FROM `clients` WHERE `id`=$id");
        if($query && $this->connection->affected_rows > 0)
        {
            if($client_image!=='no-image.jpg')
                unlink('upload/'.$client_image);
            return true;
        }
        return false;
    }
    public function __destruct()
    {
     $this->connection->close();
        //    echo'disconnected';
    }
}
