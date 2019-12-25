<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 08/07/2018
 * Time: 11:54 ص
 */
class users
{
    private $connection;
    public function __construct()
    {
        $this->connection=new mysqli(SERVER,DBUSER,DBPASS,DBNAME);
        if(!$this->connection)
            exit('Error : '.$this->connection->error);
    }
    public function login($username,$password)
    {
        $query      = $this->connection->query("SELECT * FROM `users` WHERE `username`='$username' AND `password` = '$password'");
        if($query->num_rows>0)
        {
            $_SESSION['username']=$username;
            return true;
        }
        else
        {
            return false;
        }
    }
    public function CheckLogin()
    {
        //return isset($_SESSION['username']);
        if(isset($_SESSION['username']))
            return true;
        return false;
    }
    public function logout()
    {
        session_destroy();
    }
    public function add_user($username,$password,$image='no-image.jpg')
    {
        //query
        $query = $this->connection->query("INSERT INTO `users`(`username`, `password`,`image`) VALUES ('$username','$password','$image')");
        if($this->connection->affected_rows>0)
        {
            return true;
        }
        else
        return false;
    }
    public function updateUser($id,$password,$image)
    {
                //2-query
        $query = $this->connection->query("UPDATE `users` SET `password`='$password',`image`='$image' WHERE `id`=$id");

        if($query && $this->connection->affected_rows >0)
        {
            //3- close
            return true;
        }
        //3- close
        return false;
    }
    public function delete_user($id)
    {

        $user_data = $this->getUser($id);
        $user_image= $user_data['image'];
        //query
        $query = $this->connection->query("DELETE FROM `users` WHERE `id`=$id");
        if($this->connection->affected_rows>0)
        {
            if($user_image !== 'no-image.jpg')
                unlink('upload/'.$user_image);
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getUsers()
    {
        //2-query
        $query = $this->connection->query("SELECT * FROM `users`");
        $Users = [];
        if($query->num_rows >0)
        {
            while($row = $query->fetch_assoc())
                $Users[] = $row;
        }
        //3- close
        return $Users;
    }
    public function getUser($id)
    {
        //2-query
        $query = $this->connection->query("SELECT * FROM `users` WHERE `id`=$id");
        $client = [];
        if($query->num_rows >0)
        {
            $client = $query->fetch_assoc();
        }
        //3- close
        return $client;
    }
    public function search_user($keyword)
    {
        //query
        $query = $this->connection->query("SELECT * FROM `users` WHERE `username` LIKE '%$keyword%'");
        $users=[];//store users data
        if($query->num_rows>0)
        {
            while($row=$query->fetch_assoc())
                $users[]=$row;
        }
        else
        return $users;
    }
    public function destruct()
    {
        $this->connection->close();
    }
}
