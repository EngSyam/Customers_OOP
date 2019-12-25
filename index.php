<?php
/**
 * Created by PhpStorm.
 * User: Eng Syam
 * Date: 06/07/2018
 * Time: 10:28 ص
 */
session_start();
require('includes/config.php');
require('includes/ClientsClass.php');
require('includes/usersClass.php');
$user= new users();
if(!$user->CheckLogin())
    header("LOCATION:login.php");

$get=new clients();
$clients =$get->getClients();
?>
<html>
    Welcome <?php echo $_SESSION['username'];?> || <a href="logout.php">logout</a> <hr>
    <h1>MY CLIENTS</h1>
    <form action="search.php"method="get">
        Search <input type="text" name="keyword">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>city</th>
        <th>phone</th>
        <th>image</th>
        <th>controller</th>
        <?php
        foreach($clients as $client)
        {
            $id    = $client['id'];
            $name  = $client['name'];
            $email = $client['email'];
            $city  = $client['city'];
            $phone = $client['phone'];
            $image = $client['image'];
            echo
            "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$email</td>
                <td>$city</td>
                <td>$phone</td>
                <td><img width='100' height='100' src='upload/$image'></td>
                <td>
                <a href='update.php?id=$id'>UPDATE</a>
                <a href='delete.php?id=$id'>DELETE</a>
                </td>
            </tr>
            ";
        }
        ?>
    </table>
    <a href="add.php">Add New Client</a><br>
    <a href="Add_User.php">Add New User</a>
</html>
